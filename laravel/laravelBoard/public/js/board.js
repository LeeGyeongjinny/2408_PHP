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
                const modalName = document.querySelector('#modalName');

                modalTitle.textContent = response.data.b_title;
                modalContent.textContent = response.data.b_content;
                modalCreatedAt.textContent = response.data.created_at;
                modalImg.setAttribute('src', response.data.b_img);
                modalName.textContent = response.data.u_id;
            })
            .catch(error => {
                console.error(error);
            });
        });
    })

    
    document.querySelector('#btnInsert').addEventListener('click', () => {
        window.location = '/boards/create?bc_type=' + document.querySelector('#inputBoardType').value;
    });

})();