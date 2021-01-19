document.getElementById('userPassword2').addEventListener('change', (event)=> {
    if ((event.target.value) !== document.getElementById('userPassword').value)
    {
        document.querySelector('p.no-pass').classList.remove('success-message');
        document.querySelector('p.no-pass').classList.add('error-message');
        document.querySelector('p.no-pass').textContent = 'Введеные пароли не совпадают';
    }   
    else 
    {
        document.querySelector('p.no-pass').classList.remove('error-message');
        document.querySelector('p.no-pass').classList.add('success-message');
        document.querySelector('p.no-pass').textContent = 'Введеные пароли совпадают совпадают';
        document.querySelector('p.no-pass').style.padding = '10px';
    }
})
