import axios from "../../axios";
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        boardList: [],
        page: 0, // 현재 페이지 초기값
        boardDetail: null, // 상세정보 저장
        controllFlg: true, // 디바운싱
        lastPageFlg: false,
    }),
    mutations: {
        setBoardList(state, boardList) {
            // state.boardList = boardList; // scroll comment
            state.boardList = state.boardList.concat(boardList);
        },
        // setBoardListConcat(state, boardList) {
        //     state.boardList = state.boardList.concat(boardList);
        // }, // scroll comment
        setPage(state, page) {
            state.page = page;
        },
        setBoardDetail(state, board) {
            state.boardDetail = board;
        },
        setBoardListUnshift(state, board) {
            state.boardList.unshift(board);
        },
        setControllFlg(state, flg) {
            state.controllFlg = flg;
        },
        setLastPageFlg(state, flg) {
            state.lastPageFlg = flg;
        },
    },
    actions: {
        /**
         * 게시글 획득
         * 
         * @param {*}   context
         */
        // boardListPagination(context, scrollFlg) { // scroll comment
        boardListPagination(context) {
            context.dispatch('user/chkTokenAndContinueProcess'
                , () => {
                    // 디바운싱 처리 시작
                    if(context.state.controllFlg && !context.state.lastPageFlg) {
                        // context.state.controllFlg 초기값 = true
                        context.commit('setControllFlg', false);
            
                        const url = '/api/boards?page=' + context.getters['getNextPage'];
                        const config = {
                            headers: {
                                'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                            }
                        }
            
                        axios.get(url, config)
                        .then(response => {
                            // console.log(response);
        
                            // scroll comment 여기부터
                            // if(scrollFlg) {
                            //     // 기존 게시글 데이터에 새 게시글 추가
                            //     context.commit('setBoardListConcat', response.data.boardList.data);
                            // } else {
                            //     // 초기 게시글 데이터 셋
                            //     context.commit('setBoardList', response.data.boardList.data);
                            // }
                            // context.commit('setPage', response.data.boardList.current_page);
                            // scroll comment 이까지
        
                            // console.log('보드리스트 획득', response.data.boardList);
                            context.commit('setBoardList', response.data.boardList.data);
                            context.commit('setPage', response.data.boardList.current_page);
                            
                            // 더 이상 불러올 데이터가 없을시, 불필요한 요청 안보내기 위한 처리
                            if(response.data.boardList.current_page >= response.data.boardList.last_page) {
                                // 마지막 페이지일 경우 플래그 true
                                context.commit('setLastPageFlg',  true);
                            } 
                        }) 
                        .catch(error => {
                            console.error(error);
                        })
                        .finally(() => {
                            context.commit('setControllFlg', true);  // true로 바꿔주는 것은 반드시 axios 내부에 있어야한다
                        });
                    }
                }
                , {root: true})

        },
        
        /**
         * 게시글 상세 정보 획득
         * 
         * @param {*}   context
         * @param {int} id
         */

        showBoard(context, id) {
            context.dispatch('user/chkTokenAndContinueProcess'
                ,() => {
                    const url= 'api/boards/' + id;
                    const config = {
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                        }
                    }
        
                    axios.get(url, config)
                    .then(response => {
                        // console.log(response);
                        context.commit('board/setBoardDetail', response.data.board, {root: true});
                    })
                    .catch(error => {
                        console.error(error);
                    });
                }
                , {root: true})
        },

        /**
         * 게시글 작성
         */
        storeBoard(context, data) {
            context.dispatch('user/chkTokenAndContinueProcess'
                , () => {
                    if(context.state.controllFlg) {
                        context.commit('setControllFlg', false);
        
                        const url = '/api/boards';
                        const config = {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                                'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                            }
                        }
                        const formData = new FormData();
                        formData.append('content', data.content);
                        formData.append('file', data.file);
            
                        axios.post(url, formData, config)
                        .then(response => {
                            context.commit('setBoardListUnshift', response.data.board);
        
                            // 다른 모듈 접근
                            context.commit('user/setUserInfoBoardsCount', null, {root: true});
                            
                            router.replace('/boards');
                        })
                        .catch(error => {
                            console.error(error);
                        })
                        .finally(() => {
                            context.commit('setControllFlg', true);
                        });
                    }
                }
                , {root: true})
        },
    },
    getters: {
        getNextPage(state) {
            return state.page + 1;
        },
    }
}