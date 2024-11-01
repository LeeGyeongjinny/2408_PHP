const BTN_CALL = document.querySelector('#btn_call');
BTN_CALL.addEventListener('click', getList);

function getList() {
  const URL = document.querySelector('#url').value;

  // GET
  // axios.get(url, [여기는 option])
  axios.get(URL)
  .then(response => {
    // console.log(response); // response 정보 확인
    response.data.forEach(item => {
      // console.log(item.download_url); // 주소 가져오는지 확인
      const NEW = document.createElement('img');
      NEW.setAttribute('src', item.download_url);
      NEW.style.width = '200px';
      NEW.style.height = '200px';

      document.querySelector('.container').appendChild(NEW);
    }) // index는 필요없을듯
  })
  .catch(error => {
    console.log(error);
  })
}