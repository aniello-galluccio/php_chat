const creaDivMessaggio = (idMex, testo, isMyMex) => {
    if(isMyMex)
        classeAlert = 'alert alert-secondary alert-dismissible fade show';
    else
        classeAlert = 'alert alert-primary alert-dismissible fade show';

    const mexDiv = document.createElement('div');
    mexDiv.setAttribute('class', classeAlert);
    mexDiv.setAttribute('role', 'alert');
    mexDiv.innerHTML = testo;

    if(isMyMex)
    {
        const btn = document.createElement('button');
        btn.setAttribute('type', 'button');
        btn.setAttribute('class', 'close');
        btn.setAttribute('data-dismiss', 'alert');
        btn.setAttribute('aria-label', 'Close');
        btn.setAttribute('id', String(idMex));
        btn.setAttribute('onClick', `deleteMex(${idMex})`);
        btn.innerHTML = '<span aria-hidden="true">&times;</span>';

        mexDiv.appendChild(btn);
    }
    document.getElementById('chat').appendChild(mexDiv);
    let objDiv = document.getElementById("chat");
    objDiv.scrollTop = objDiv.scrollHeight;
}

const deleteMex = idMex => {
    fetch(`delete_mex.php?id=${idMex}`);
}


window.addEventListener('load', () => {
    let cont=0;
    const url = new URL(window.location.href);

    const friendId = url.searchParams.get("user");
    const myId = url.searchParams.get("myid");

    if(myId && friendId)
    {
        fetch('get_mex_list.php', {
            method: "POST",
            body: `myid=${myId}&friendid=${friendId}`,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        })
        .then(res => res.json())
        .then(res => res.forEach(el => creaDivMessaggio(el.id, el.testo, (el.mittente == myId))));
    }

    btnSend = document.getElementById('btn_send');

    btnSend.addEventListener('click', () => {
        const testo = document.getElementById('input_mex').value;
        let contRef = cont;
        cont++;
        creaDivMessaggio('new_mex' + contRef, testo, true);
        fetch('insert_mex.php', {
            method: "POST",
            body: `mitt=${myId}&dest=${friendId}&text=${testo}`,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        })
        .then(res => res.text())
        .then(res => {
            document.getElementById('new_mex' + contRef).setAttribute('id', res);
            document.getElementById(res).setAttribute('onClick', `deleteMex(${res})`);
        });
        document.getElementById('input_mex').value = "";
    });

    setInterval(() => {
        fetch('check_mex.php', {
            method: "POST",
            body: `myid=${myId}&friendid=${friendId}`,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        })
        .then(res => res.json())
        .then(res => res.forEach(el => creaDivMessaggio(el.id, el.testo, false)));
    }, 2000);
});