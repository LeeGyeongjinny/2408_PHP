import { createStore } from 'vuex';
import user from './modules/user'; // js는 .js 생략 가능
import board from './modules/board';

export default createStore({
    modules: {
        user,
        board,
    },
})