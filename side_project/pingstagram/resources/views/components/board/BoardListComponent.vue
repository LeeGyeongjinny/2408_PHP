<template>
    <!-- BoardList -->
    <div class="board-list-box">
        <div @click="openModal" class="item">
            <img src="/img/saecomping.png" alt="">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/saecomping.png" alt="">
        </div>
        <div @click="openModal" class="item">
            <img src="/img/saecomping.png" alt="">
        </div>
    </div>

    <!-- Detail Modal -->
    <div v-show="modalFlg" class="board-detail-box">
        <div class="item">
            <img src="/img/trustping.png" alt="">
            <hr>
            <p>제목</p>
            <hr>
            <p>내용내용</p>
            <hr>
            <div class="etc-box">
                <span>작성자 : 나다</span>
                <div class="etc-box-btn">
                    <button class="btn btn-header btn-bg-black">수정</button>
                    <button class="btn btn-header btn-bg-black">삭제</button>
                    <button @click="closeModal" class="btn btn-header btn-bg-black">닫기</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import { onBeforeMount, ref } from 'vue';

onBeforeMount(() => {
    console.log('비포마운트 확인');
});


// Modal
const modalFlg = ref(false);
const openModal = () => {
    modalFlg.value = true;
}
const closeModal = () => {
    modalFlg.value = false;
}

</script>

<style>
@import url('../../../css/boardList.css');
</style>