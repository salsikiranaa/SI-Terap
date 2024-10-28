<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TEST API</title>
</head>

@php
    // , Crypt::encryptString()
    // $endpoint = route('manage.service.unlock', Crypt::encryptString(1));
    $endpoint = '/';
    $method = '';
    $input = [
        ['name' => '', 'type' => '', 'value' => ''],
        // ['name' => 'provinsi_id', 'type' => 'number', 'value' => 11],
        // ['name' => 'alamat', 'type' => 'text', 'value' => 'di aceh weh pokona'],
    ];
    $input_types = ['text', 'number', 'date'];
    $methods = ['GET', 'POST', 'PUT', 'DELETE'];
@endphp

<body style="height: 100dvh;">
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 5px; width: 100%; height: 100%;">
        <div style="display: flex; align-items: center; justify-content: center; gap: 5px;">
            <select name="" id="http-method" onchange="handleHttpMethod(this.value)">
                @foreach ($methods as $met)
                    <option value="{{ $met }}" {{ $method == $met ? 'selected' : '' }}>{{ $met }}</option>
                @endforeach
            </select>
            <input type="text" value="/" id="endpoint" oninput="handleEndpoint()">
            {{-- <div style="display: none; gap: 5px;" id="encrypter">
                <input type="text" id="encrypter-id" style="width: 50px; border: 1px solid green; background-color: rgb(183, 228, 183);" placeholder="id" oninput="handleEndpoint()">
                <input type="text" value="/" id="encrypter-end" style="width: 80px;" oninput="handleEndpoint()">
            </div> --}}
            <button type="submit" onclick="handleGo()">Go</button>
        </div>
        {{-- <button type="button" onclick="handleShowEncrypter()">Encrypter</button> --}}
        <form id="form" target="_blank" style="display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 5px;">
            {{-- @if ($method != 'GET')
                @csrf
            @endif
            @if ($method == 'PUT' || $method == 'DELETE')
                @method($method)
            @endif --}}
            <div>Requests:</div>
            <div id="input-container" style="display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 5px;">
                <div class="request-row" style="display: flex; align-items: center; justify-content: center; gap: 5px;">
                    <input type="text" placeholder="key" onchange="handleInputKey(0, this.value)">:
                    <input class="input-value" placeholder="value">
                    <select name="" id="" onchange="handleInputType(0, this.value)">
                        @foreach ($input_types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
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
        const inputValues = document.getElementsByClassName('input-value')
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
            // const crypt = encryptId.value ? "{{ Crypt::encryptString(".encryptId.value.") }}" : ''
            // const formAction = `${endpoint.value}${crypt}${encryptEnd.value}`
            // console.log(formAction);
            
            // form.action = formAction
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
            inputValues[index].name = key
        }
        const handleInputType = (index, type) => {
            inputValues[index].type = type
        }

        const handleAddRequest = () => {
            const inputContainer = document.getElementById('input-container')
            inputContainer.innerHTML = `${inputContainer.innerHTML}<div class="request-row" style="display: flex; align-items: center;justify-content: center; gap: 5px;"><input type="text" placeholder="key" onchange="handleInputKey(${inputValues.length}, this.value)">:<input class="input-value" placeholder="value"><select name="" id="" onchange="handleInputType(${inputValues.length}, this.value)">@foreach ($input_types as $type)<option value="{{ $type }}">{{ $type }}</option>@endforeach</select></div>`
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