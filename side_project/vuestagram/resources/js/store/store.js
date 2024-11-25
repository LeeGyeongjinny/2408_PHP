import { createStore } from 'vuex';
import user from './modules/user'; // js는 .js 생략 가능

export default createStore({
    modules: {
        user,
    },
})