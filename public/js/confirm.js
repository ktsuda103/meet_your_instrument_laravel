function deleteHandle(event){
    event.preventDefault();
    if(window.confirm('本当に削除しますか？')){
        document.getElementById('delete-form').submit();
    } else {
        alert('キャンセルしました');
    }
}

const scrollTopButton = document.querySelector('#start-btn');
scrollTopButton.addEventListener('click',() => {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
});