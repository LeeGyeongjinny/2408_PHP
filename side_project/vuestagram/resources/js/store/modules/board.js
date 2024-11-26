import axios from "../../axios";
// import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        boardList: [],
        page: 0, // 현재 페이지 초기값
    }),
    mutations: {
        setBoardList(state, boardList) {
            state.boardList = boardList;
        },
        setPage(state, page) {
            state.page = page;
        },
    },
    actions: {
        /**
         * 게시글 획득
         * 
         * @param {*}   context
         */
        getBoardListPagination(context) {
            const url = '/api/boards?page=' + context.getters['getNextPage'];
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.get(url, config)
            .then(response => {
                // console.log(response);
                context.commit('setBoardList', response.data.boardList.data);
                context.commit('setPage', response.data.boardList.current_page);
            }) 
            .catch(error => {
                console.error(error);
            });
        },
    },
    getters: {
        // state의 값을 특정 연산을 이용해서 가져와야할 때 
        getNextPage(state) {
            return state.page + 1;
        },
    }
}