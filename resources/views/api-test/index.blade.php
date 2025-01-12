<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TEST API</title>
</head>

<style>
    table {
        border-collapse: collapse;
    }
    table td {
        border: 1px solid black;
        padding: 5px;
    }
</style>

@php
    $input_types = ['text','textarea', 'number', 'date', 'month', 'array_text', 'file'];
    $methods = ['GET', 'POST', 'PUT', 'DELETE'];
@endphp

<body style="height: 100dvh;">
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 5px; width: 100%; height: 100%;">
        <div style="display: flex; align-items: center; justify-content: center; gap: 5px;">
            <select name="" id="http-method" onchange="handleHttpMethod(this.value)">
                @foreach ($methods as $met)
                    <option value="{{ $met }}">{{ $met }}</option>
                @endforeach
            </select>
            <input type="text" value="/" id="endpoint" style="width: 350px" oninput="handleEndpoint()">
            <button type="submit" onclick="handleGo()">Go</button>
        </div>
        <form id="form" target="_blank" style="display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 5px;">
            <table>
                <thead>
                    <tr>
                        <th rowspan="3" style="text-align: left"><div>Requests:</div></th>
                    </tr>
                </thead>
                <tbody id="input-container">
                    <tr class="request-row">
                        <td><input class="input-key" type="text" placeholder="key" onchange="handleInputKey(0, this.value)"></td>
                        <td class="input-value-container"><input class="input-value" placeholder="value"></td>
                        <td>
                            <select class="input-type" name="" id="" onchange="handleInputType(0, this.value)">
                                @foreach ($input_types as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <button type="button" onclick="handleRemoveRequest()"> - </button>
                <button type="button" onclick="handleAddRequest()">+</button>
            </div>
        </form>
    </div>

    <script>
        const form = document.getElementById('form')
        const httpMethod = document.getElementById('http-method')
        const endpoint = document.getElementById('endpoint')
        const encryptId = document.getElementById('encrypter-id')
        const encryptEnd = document.getElementById('encrypter-end')
        const inputKey = document.getElementsByClassName('input-key')
        const inputValueContainer = document.getElementsByClassName('input-value-container')
        const inputValues = document.getElementsByClassName('input-value')
        const inputType = document.getElementsByClassName('input-type')
        const requestRow = document.getElementsByClassName('request-row')
        

        const handleHttpMethod = (method) => {
            form.method = method == 'GET' ? 'GET' : 'POST'
            if (method == 'PUT' || method == 'DELETE') {
                form.innerHTML = `@csrf @method('${method}') ${form.innerHTML}`
            } else if (method == 'POST') {
                form.innerHTML = `@csrf ${form.innerHTML}`
            }
        }

        const handleEndpoint = () => {
            form.action = endpoint.value
        }

        const handleShowEncrypter = () => {
            let encrypterDisplay = document.getElementById('encrypter').style
            if (encrypterDisplay.display == 'none') encrypterDisplay.display = 'flex'
            else {
                encryptId.value = ''
                encryptEnd.value = ''
                encrypterDisplay.display = 'none'
            }
        }
        
        const handleInputKey = (index, key) => {
            if (inputType[index].value == 'array_text') {
                const inputs = inputValues[index].children
                for (let i = 0; i < inputs.length - 1; i++) {
                    inputs[i].name = `${key}[]`
                }
            } else inputValues[index].name = key
        }
        const handleInputType = (index, type) => {
            if (type == 'textarea' && inputValues[index].tagName != 'TEXTAREA') {
                const textarea = document.createElement('textarea')
                textarea.className = 'input-value'
                textarea.placeholder = 'value'
                textarea.name = inputKey[index].value
                inputValues[index].replaceWith(textarea)
            } else if (type == 'array_text') {
                const div = document.createElement('div')
                div.style = 'display:flex;flex-direction:column;align-items-center;justify-content-center;gap:5px'
                div.className = 'input-value'
                div.innerHTML = `<input type="text" name="${inputKey[index].value}[]" placeholder="value">
                <button type="button" onclick="handleAddArrayText(${index})">+</button>`
                inputValues[index].replaceWith(div)
            } else if (inputValues[index].tagName != 'INPUT') {
                const input = document.createElement('input')
                input.className = 'input-value'
                input.placeholder = 'value'
                input.type = type
                input.name = inputKey[index].value
                inputValues[index].replaceWith(input)
            } else {
                inputValues[index].type = type
            }
        }

        const handleAddArrayText = (index) => {
            console.log(inputType[index].value)
            if (inputType[index].value == 'array_text') {
                const input = document.createElement('input')
                input.type = 'text'
                input.name = `${inputKey[index].value}[]`
                input.placeholder = 'value'
                const containerChildren = inputValues[index].children
                inputValues[index].insertBefore(input, containerChildren[containerChildren.length - 1])
            }
        }

        const handleAddRequest = () => {
            const inputContainer = document.getElementById('input-container')
            const tr = document.createElement('tr')
            tr.className = 'request-row'
            tr.innerHTML = `<td>
                <input class="input-key" type="text" placeholder="key" onchange="handleInputKey(${inputValues.length}, this.value)">
            </td>
            <td  class="input-value-container">
                <input class="input-value" placeholder="value">
            </td>
            <td>
                <select class="input-type" name="" id="" onchange="handleInputType(${inputValues.length}, this.value)">
                    @foreach ($input_types as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
            </td>`
            inputContainer.appendChild(tr)
        }

        const handleRemoveRequest = () => {
            requestRow[requestRow.length - 1].remove()
        }

        const handleGo = () => {
            form.submit()
        }
    </script>
</body>
</html>