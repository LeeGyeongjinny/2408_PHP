<template>
    <div v-for="item in products" :key="item">
        <h2 @click="openDetailModal(item)">{{ item.productName }}</h2>
        <p>{{ item.productContent }}</p>
        <span>{{ item.productPrice }}원</span>
    </div>

    <!-- detail modal -->
    <Transition name="detailModalAnimation">
        <div class="bg-modal-black" v-show="flgDetail">
            <div class="bg-modal-white">
                <h1>{{ detailProduct.productName }}</h1>
                <p>{{ detailProduct.productContent }}</p>
                <p>{{ detailProduct.productPrice }}</p>
                <button @click="closeDetailModal">닫기</button>
            </div>
        </div>
    </Transition>


    <!-- 토글을 하나로 하고 싶었어 if문으로 -->
    <!-- <div v-for="item in products" :key="item">
        <h2 @click="detailModal(item)">{{ item.productName }}</h2>
        <p>{{ item.productContent }}</p>
        <span>{{ item.productPrice }}원</span>
    </div> -->

    <!-- detail modal -->
    <!-- <Transition name="detailModalAnimation">
        <div class="bg-modal-black" v-show="flgDetail">
            <div class="bg-modal-white">
                <h1>{{ detailProduct.productName }}</h1>
                <p>{{ detailProduct.productContent }}</p>
                <p>{{ detailProduct.productPrice }}</p>
                <button @click="detailModal">닫기</button>
            </div>
        </div>
    </Transition> -->
    <!-- ------------------------------ -->
</template>

<script setup>
import { computed, ref } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

const products = computed(() => store.state.board.products);

// 상세 모달 제어
const flgDetail = ref(false);
const detailProduct = computed(() => store.state.board.detailProduct);

const openDetailModal = (item) => {
    store.commit('board/setDetailProduct', item);
    flgDetail.value = true;
}
const closeDetailModal = () => {
    flgDetail.value = false;
}

// 토글을 하나로 하고 싶었어 if문으로 ------------------------
// const detailModal = (item) => {
//     if(flgDetail.value===false) {
//         flgDetail.value = true;
//         store.commit('board/setDetailProduct', item);
//     } else {
//         flgDetail.value = false;
//     }
// }
// ---------------------------------------------------------

</script>

<style>
.bg-modal-black {
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.7);
    position: fixed;
    top: 0;
    left: 0;
}

.bg-modal-white {
    width: 80%;
    max-width: 300px;
    background-color: #fff;
    margin: 20px auto;
    padding: 20px;
}

.detailModalAnimation-enter-from {
    opacity: 0;
} /* 진입 시작 상태 */

.detailModalAnimation-enter-active {
    transition: 1s ease;
} /* 진입 활성 상태 */

.detailModalAnimation-enter-to {
    opacity: 1;
} /* 진입 종료 상태 */

.detailModalAnimation-leave-from {
    /* transform: translateX(0px); */
    /* transform: scale(1); */
    transform: rotate(0deg);
} /* 진출 시작 상태 */

.detailModalAnimation-leave-active {
    transition: all 1.5s;
} /* 진출 활성 상태 */

.detailModalAnimation-leave-to {
    /* transform: translateX(400px); */
    transform: rotate(360deg) scale(0.01);        
    border-radius:50%;
    /* transform: scale(.01); */
} /* 진출 종료 상태 */

</style>