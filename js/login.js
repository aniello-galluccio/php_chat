window.addEventListener('load', () => {
    const url = new URL(window.location.href);
    if(url.searchParams.get("log"))
    {
        document.getElementById('errore').style.display = 'block';
    }
});