export default {
    namespaced: true, // 모듈화된 스토어의 네임스페이스 활성화
    state: () => ({
        // 데이터가 저장되는 영역
        count: 0,
        products: [
            {productName: '바지', productPrice: 38000, productContent: '매우 아름다운 바지'},
            {productName: '티셔츠', productPrice: 25000, productContent: '매우 아름다운 티셔츠'},
            {productName: '양말', productPrice: 39900, productContent: '매우 비싼 양말'},
            {productName: '모자', productPrice: 1500, productContent: '알리에서 떼온 모자'},
            {productName: '니트', productPrice: 10000, productContent: '알리에서 떼온 니트 - 올 나가도 책임안짐'},
        ],
        detailProduct: {productName: '', productPrice: 0, productContent: ''}
    }),
    mutations: {
        // state의 데이터를 수정할 수 있는 함수들을 정의하는 영역
        addCount(state) {
            state.count++;
        },
        setDetailProduct(state, item) {
            state.detailProduct = item;
        }
    },
    actions: {
        // 비동기성 비즈니스 로직 함수를 정의하는 영역
    },
    getters: {
        // 추가 처리를 하여 state의 데이터를 획득하기 위한 함수들을 정의하는 영역
    },
}