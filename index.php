<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <section class="h-screen w-screen bg-slate-600 flex items-center justify-center flex-col">
        <form onsubmit="(function(e) { addFunction(e); })(event)">
            <section class="flex items-center justify-center flex-col">
                <label for="input">TODO LIST</label>
                <input type="text" id="input" name="input" placeholder="Add a new todo" required class=" rounded p-4 m-4">
                <button class="cssbuttons-io-button">
                    <svg
                        height="24"
                        width="24"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z" fill="currentColor"></path>
                    </svg>
                    <span>Add</span>
                </button>
            </section>
        </form>
        <ul class=" w-full m-8 p-4 flex flex-col justify-center items-center">
            <?php require_once 'views/read.php'; ?>
        </ul>
    </section>
    <script>
        /**
         * Creates a new todo item element.
         * @param {number} id - The ID of the todo item.
         * @param {string} task - The task description of the todo item.
         * @returns {DocumentFragment} The document fragment containing the new todo item.
         */

        function createItem(id, task) {
            // why did i use document fragment instead of appending the elements directly to the ul element?
            // i would suggest you to read my very short article on this topic https://www.linkedin.com/pulse/optimizing-dom-manipulation-document-fragments-nour-hassan-mrokf/?trackingId=yLRcG0sR0yIJ7QhBQLe1Nw%3D%3D
            const frag = document.createDocumentFragment();
            const fragLi = frag.appendChild(document.createElement('li'));
            fragLi.classList.add('w-3/4', 'flex', 'items-center', 'justify-between', 'm-2', 'p-2');
            const fragDiv1 = fragLi.appendChild(document.createElement('div'));
            fragDiv1.textContent = task;
            const fragDiv2 = fragLi.appendChild(document.createElement('div'));
            fragDiv2.classList.add('flex', 'items-center', 'justify-center', 'gap-2');
            const fragButton1 = fragDiv2.appendChild(document.createElement('button'));
            fragButton1.classList.add('shake');
            fragButton1.setAttribute('data-id', id);
            fragButton1.addEventListener('click', editFunction);
            fragButton1.textContent = 'Update';
            const fragButton2 = fragDiv2.appendChild(document.createElement('button'));
            fragButton2.classList.add('trash');
            fragButton2.setAttribute('data-id', id);
            fragButton2.addEventListener('click', deleteFunction);
            const fragButton2Svg = fragButton2.appendChild(document.createElementNS('http://www.w3.org/2000/svg', 'svg'));
            /* 
            Q: why did i use createElementNS instead of createElement?
            A: because i want to create an svg element and to create an svg element you have add the svg namespace as svg is not a normal html element.
            */
            fragButton2Svg.setAttribute('viewBox', '0 0 448 512');
            fragButton2Svg.classList.add('svgIcon');
            const fragButton2SvgPath = fragButton2Svg.appendChild(document.createElementNS('http://www.w3.org/2000/svg', 'path'));
            fragButton2SvgPath.setAttribute('d', 'M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z');
            return frag;
        }

        /**
         * Edits an existing todo item.
         * @param {number} id - The ID of the todo item.
         * @param {string} task - The task description of the todo item.
         * @param {HTMLElement} element - The HTML element representing the todo item.
         */

        function editItem(id, task, element) {
            const frag = document.createDocumentFragment();
            const fragForm = frag.appendChild(document.createElement('form'));
            fragForm.addEventListener('submit', updateFunction);
            const fragInput = fragForm.appendChild(document.createElement('input'));
            fragInput.setAttribute('name', 'input');
            fragInput.setAttribute('value', task);
            fragInput.classList.add('rounded', 'p-2');
            const fragInputHidden = fragForm.appendChild(document.createElement('input'));
            fragInputHidden.setAttribute('name', 'id');
            fragInputHidden.setAttribute('value', id);
            fragInputHidden.setAttribute('hidden', '');
            const fragButton = fragForm.appendChild(document.createElement('button'));
            fragButton.setAttribute('type', 'submit');
            fragButton.classList.add('save-button');
            const fragButtonSpan = fragButton.appendChild(document.createElement('span'));
            fragButtonSpan.textContent = 'Save';
            document.querySelector('ul').replaceChild(frag, element);
        }

        /**
         * Handles the edit button click event.
         * @param {Event} e - The event object.
         */

        function editFunction(e) {
            e.preventDefault();
            const id = e.target.getAttribute('data-id');
            const task = e.target.parentElement.previousElementSibling.textContent.trim();
            const element = e.target.parentElement.parentElement;
            editItem(id, task, element);
        }

        /**
         * Handles the form submission for updating a todo item.
         * @param {Event} e - The event object.
         */

        function updateFunction(e) {
            e.preventDefault();
            const task = e.target[0].value;
            const id = e.target[1].value;
            const ajax = new XMLHttpRequest();
            ajax.open('POST', 'update.php', true);
            ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            ajax.send('input=' + task + '&id=' + id);
            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4 && ajax.status === 200) {
                    const response = JSON.parse(ajax.responseText);
                    if (response.task.trim() === '') {
                        alert('Please enter a valid todo task');
                        return;
                    }
                    const frag = createItem(response.id, response.task);
                    document.querySelector('ul').replaceChild(frag, e.target);
                }
            }
        }

        /**
         * Handles the form submission for adding a new todo item.
         * @param {Event} e - The event object.
         */

        function addFunction(e) {
            e.preventDefault();
            const value = document.getElementById('input').value;
            if (value.trim() === '') {
                alert('Please enter a valid todo task');
                return;
            }
            const ajax = new XMLHttpRequest();
            ajax.open('POST', 'add.php', true);
            ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            ajax.send('input=' + value);
            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4 && ajax.status === 200) {
                    const response = JSON.parse(ajax.responseText);
                    const frag = createItem(response.id, response.task);
                    document.querySelector('ul').appendChild(frag);
                }
            }
        }

        /**
         * Handles the delete button click event.
         * @param {Event} e - The event object.
         */

        function deleteFunction(e) {
            e.preventDefault();
            const id = e.target.getAttribute('data-id');
            const ajax = new XMLHttpRequest();
            ajax.open('GET', 'delete.php?id=' + id, true);
            ajax.send();
            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4 && ajax.status === 200) {
                    e.target.parentElement.parentElement.remove();
                }
            }
        }
    </script>
</body>

</html>