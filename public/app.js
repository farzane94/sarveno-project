const API_URL = '/api/items';

document.getElementById('search-input').addEventListener('input', (e) => {
    fetchItems(e.target.value);
});

async function fetchItems(keyword = '') {
    const url = keyword ? `${API_URL}?keyword=${encodeURIComponent(keyword)}` : API_URL;

    const res = await fetch(url);
    const items = await res.json();
    const list = document.getElementById('items-list');
    list.innerHTML = '';

    items.forEach(item => {
        const li = document.createElement('li');
        li.className = item.is_checked ? 'checked' : '';
        li.setAttribute('data-id', item.id);

        const span = document.createElement('span');
        span.innerText = item.name;

        const actions = document.createElement('div');

        const checkBtn = document.createElement('button');
        checkBtn.innerText = '✔';
        checkBtn.onclick = () => toggleCheck(item.id, !item.is_checked);

        const editBtn = document.createElement('button');
        editBtn.innerText = '✏️';
        editBtn.onclick = () => startInlineEdit(li, item);

        const deleteBtn = document.createElement('button');
        deleteBtn.innerText = '🗑';
        deleteBtn.onclick = () => deleteItem(item.id);

        actions.append(checkBtn, editBtn, deleteBtn);

        li.append(span, actions);
        list.appendChild(li);
    });
}

function startInlineEdit(li, item) {
    li.innerHTML = '';

    const input = document.createElement('input');
    input.type = 'text';
    input.value = item.name;

    const saveBtn = document.createElement('button');
    saveBtn.innerText = '💾';
    saveBtn.onclick = async () => {
        const newName = input.value.trim();
        if (!newName) return;
        await fetch(`${API_URL}?id=${item.id}`, {
            method: 'PUT',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({name: newName})
        });
        fetchItems();
    };

    const cancelBtn = document.createElement('button');
    cancelBtn.innerText = '❌';
    cancelBtn.onclick = () => fetchItems();

    // 📦 قرار دادن input و دکمه‌ها در یک container
    const editBox = document.createElement('div');
    editBox.className = 'edit-box';
    editBox.append(input, saveBtn, cancelBtn);

    li.append(editBox);
}


document.getElementById('item-form').addEventListener('submit', async e => {
    e.preventDefault();
    const name = document.getElementById('item-input').value;
    await fetch(API_URL, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({name})
    });
    document.getElementById('item-input').value = '';
    fetchItems();
});

async function deleteItem(id) {
    await fetch(`${API_URL}?id=${id}`, {method: 'DELETE'});
    fetchItems();
}

async function toggleCheck(id, status) {
    await fetch(`${API_URL}/toggle?id=${id}`, {
        method: 'PATCH',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({is_checked: status})
    });
    fetchItems();
}

fetchItems();
