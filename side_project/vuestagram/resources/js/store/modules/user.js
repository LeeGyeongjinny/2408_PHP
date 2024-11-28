// import axios from "axios";
import axios from "../../axios";
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        // accessToken: localStorage.getItem('accessToken') ? localStorage.getItem('accessToken') : '',
        authFlg: localStorage.getItem('accessToken') ? true : false,
        userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : {},
    }),
    mutations: {
        // setAccessToken(state, accessToken) {
        //     state.accessToken = accessToken;
        //     localStorage.setItem('accessToken', accessToken);
        // },
        setAuthFlg(state, flg) {
            state.authFlg = flg;
        },
        setUserInfo(state, userInfo) {
            state.userInfo = userInfo;
        },
        setUserInfoBoardsCount(state) {
            state.userInfo.boards_count++;
            localStorage.setItem('userInfo', JSON.stringify(state.userInfo));
        },
    },
    actions: {
        // ---------------------
        // 인증 관련 
        // ---------------------
        /**
         * 로그인 처리
         * 
         * @param {*}   context
         * @param {*}   userInfo
         */
        login(context, userInfo) {
            const url = '/api/login';
            const data = JSON.stringify(userInfo);
            // const config = {
            //     headers: {
            //         'Content-Type': 'application/json'
            //     }
            // }

            // axios.post(url, data, config)
            axios.post(url, data)
            .then(response => {
                // console.log(response);

                // 토큰 저장
                // context.commit('setAccessToken', response.data.accessToken);
                localStorage.setItem('accessToken', response.data.accessToken);
                localStorage.setItem('refreshToken', response.data.refreshToken);
                localStorage.setItem('userInfo', JSON.stringify(response.data.data));
                context.commit('setAuthFlg', true);
                context.commit('setUserInfo', response.data.data);

                alert('어서와 처음이지');

                // 보드 리스트로 이동
                router.replace('/boards');
            })
            .catch(error => {
                let errorMsgList = [];
                const errorData = error.response.data;

                // console.log(error.response);
                if(error.response.status === 422) {
                    // 유효성 체크 에러
                    if(errorData.data.account) {
                        errorMsgList.push(errorData.data.account[0]);
                    }

                    if(errorData.data.password) {
                        errorMsgList.push(errorData.data.password[0]);
                    }
                } else if(error.response.status === 401) {
                    // 비밀번호 오류
                    errorMsgList.push(errorData.msg);
                    // errorMsgList.push('비밀번호가 틀렸습니다.');
                } else {
                    errorMsgList.push('예기치 못한 오류 발생');
                }

                alert(errorMsgList.join('\n'));
            });
        },

        /**
         * 로그아웃 처리
         * 
         * @param {*}   context
         */
        logout(context) {
            // TODO : 백엔드 처리 추가
            const url = '/api/logout';
            const config = {
                headers: {
                    // content-type은 기본으로 세팅했기 때문에 다시 안해줘도됨
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                } // bearer token 세팅
            }

            axios.post(url, null, config)
            .then(response => {
                alert('로그아웃 완료');
            })
            .catch(error => {
                alert('문제가 발생하여 로그아웃 처리');
            })
            .finally(() => {
                localStorage.clear(); // 로컬스토리지 비우기
    
                // state 초기화
                context.commit('setAuthFlg', false);
                context.commit('setUserInfo', {});
    
                router.replace('/login');
            });
        },

        /**
         * 회원가입 처리
         * 
         * @param {*}   context
         * @param {*}   userInfo
         */
        registration(context, userInfo) {
            // 회원가입은 유저인증 필요없어서 accessToken 당연히 필요없음
            const url = '/api/registration';
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            };

            // form data 셋팅
            const formData = new FormData();
            formData.append('account', userInfo.account);
            formData.append('password', userInfo.password);
            formData.append('password_chk', userInfo.password_chk);
            formData.append('name', userInfo.name);
            formData.append('gender', userInfo.gender);
            formData.append('profile', userInfo.profile);

            axios.post(url, formData, config)
            .then(response => {
                alert('회원가입 성공\n가입 하신 계정으로 로그인 해주세요.');

                // 로그인 페이지로
                router.replace('/login');
            }) 
            .catch(error => {
                alert('회원가입 실패');
            });
        },

        /**
         * 토큰 만료 체크 후 처리 속행
         * 
         * @param {*}   context
         * @param {Function}    callbackProcess
         */
        chkTokenAndContinueProcess(context, callbackProcess) {
            // Payload 획득
            const payload = localStorage.getItem('accessToken').split('.')[1];
            const base64 = payload.replace(/-/g, '+').replace(/_/g, '/');
            const objPayload = JSON.parse(window.atob(base64));
            // console.log(payload, base64, objPayload);
            
            const now = new Date();

            // console.log(objPayload.exp * 1000 <= now.getTime());
            if((objPayload.exp * 1000) > now.getTime()){
                // 토큰 유효
                callbackProcess();
            } else {
                // 토큰 만료
                
                // 토큰 재발급 필요
                context.dispatch('reissueAccessToken', callbackProcess);
            }

        },

        /**
         * 토큰 재발급 처리
         * 
         * @param {*}   context
         * @param {callback}    callbackProcess
         */
        
        reissueAccessToken(context, callbackProcess) {
            // console.log('토큰 재발급 처리');
            // callbackProcess(); 
            const url = '/api/reissue';
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('refreshToken')
                }
            };

            axios.post(url, null, config)
            .then(response => {
                // 토큰 세팅
                localStorage.setItem('accessToken', response.data.accessToken);
                localStorage.setItem('refreshToken', response.data.refreshToken);

                // 후속 처리 진행
                callbackProcess();
            })
            .catch(error => {
                console.error(error);
            });
        },


        // 장난 - 유저정보 모달
        showUser(context, id) {
            const url = 'api/boards/' + id;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.get(url, config)
            .then(response => {
                // console.log(response.data.user);
                // console.log(response);
                context.commit('setUserInfo', response.data.user);
            })
            .catch(error => {
                console.error(error);
            });
        },
        // 장난 --------
    
    },
    getters: {

    }
}