export default {
    namespaced: true,
    state: () => ({
        boardList: [],
        page:0,
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
        getBoardListPagination(context) {
            const url = '/api/boards?page=' + context.state.page;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.get(url, config)
            .then(response => {
                context.commit('setBoardList', response.data.boardList.data);
                context.commit('setPage', response.data.boardList.current_page);
            }) 
            .catch(error => {
                console.error(error);
            });
        },
    },
    getters: {
        getNextPage(state) {
            return state.page + 1;
        },
    }
}