<template>
    <div class="user-info-box">
        <img src="/profile/trustping.png">
        <div class="user-info-content">
            <h2>유저아이디</h2>
            <h3>작성글 수 : 999</h3>
        </div>
        <router-link to="/boards/create"><button class="btn btn-submit">글 작성</button></router-link>
    </div>
</template> 

<script setup>

</script>

<style>
@import url('../../../css/userInfo.css');
</style>