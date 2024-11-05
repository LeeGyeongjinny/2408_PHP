<?php

// 세션 시작 : 세션 시작 전에 출력처리가 있으면 안된다.
session_start();

echo $_SESSION['test_session'];