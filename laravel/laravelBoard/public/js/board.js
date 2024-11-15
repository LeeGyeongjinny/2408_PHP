(() => {
    document.querySelectorAll('.my-btn-detail').forEach(node => {
        node.addEventListener('click', e => {
            const url = '/boards/' + e.target.value;

            axios.get(url)
            .then(response => {
                const modalTitle = document.querySelector('#modalTitle');
                const modalContent = document.querySelector('#modalContent');
                const modalCreatedAt = document.querySelector('#modalCreatedAt');
                const modalImg = document.querySelector('#modalImg');
                // const modalName = document.querySelector('#modalName');
                const modalDeleteParent = document.querySelector('#modalDeleteParent');


                modalTitle.textContent = response.data.b_title;
                modalContent.textContent = response.data.b_content;
                modalCreatedAt.textContent = response.data.created_at;
                modalImg.setAttribute('src', response.data.b_img);
                // modalName.textContent = response.data.u_id;
                modalDeleteParent.textContent = ''; // 기존에 있던 삭제버튼은 사라짐

                if(response.data.delete_flg) {
                    const newButton = document.createElement('button');
                    newButton.textContent = 'Delete';
                    newButton.setAttribute('type', 'button');
                    newButton.setAttribute('class', 'btn btn-warning'); // classList로 넣어도 됨
                    newButton.setAttribute('onclick', `boardDestroy(${e.target.value})`);
                    newButton.setAttribute('data-bs-dismiss', 'modal'); // 삭제버튼을 누르는 순간 닫힘
                    
                    modalDeleteParent.appendChild(newButton);
                }
            })
            .catch(error => {
                console.error(error);
            });
        });
    })


    // 실습
    // document.querySelector('#btnInsert').addEventListener('click', () => {
    //     window.location = '/boards/create?bc_type=' + document.querySelector('#inputBoardType').value;
    // });
    
})();

function redirectInsert($type) {
    window.location = '/boards/create?bc_type=' + $type;
}

function boardDestroy($id) {
    const url = '/boards/' + $id;

    axios.delete(url)
    .then(response => {
        if(response.data.success) {
            const deleteNode = document.querySelector('#card' + $id);
            deleteNode.remove();
        } else {
            alert('삭제 실패');
        }
    })
    .catch(error => {
        console.log(error);
        alert('에러 발생');
    })
}