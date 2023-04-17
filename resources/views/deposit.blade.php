@extends('layouts.test')

@section('title', 'withdraw')

@section('content')

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5jv1wvr5OnKe1mr2Au2jgq3a2CQEvW5t79jF0IC/" crossorigin="anonymous">

    <style>

.main-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 500px;
}
.custom-container {
    --container-padding: 32px;
    padding: var(--container-padding);
    font-family: Flama, sans-serif;
    font-size: 0.9375rem;
    color: rgba(146, 147, 166, 1);
    line-height: inherit;
    box-sizing: border-box;
    border-width: 0;
    border-style: solid;
    border-color: currentColor;
}
.card {
  width: 195px;
  height: 200px;
  margin-right: 20px;
  background: #313131;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: white;
  transition: 0.2s ease-in-out;
}

.img {
  height: 45%;
  position: absolute;
  transition: 0.2s ease-in-out;
  z-index: 1;
}

.textBox {
  opacity: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 15px;
  transition: 0.2s ease-in-out;
  z-index: 2;
}

.textBox > .text {
  font-weight: bold;
}

.textBox > .head {
  font-size: 20px;
}

.textBox > .price {
  font-size: 17px;
}

.textBox > span {
  font-size: 12px;
  color: lightgrey;
}

.card:hover > .textBox {
  opacity: 1;
}

.card:hover > .img {
  height: 65%;
  animation: anim 2s infinite;
}

@keyframes anim {
  0% {
    transform: translateY(0);
  }

  50% {
    transform: translateY(-10px);
  }

  100% {
    transform: translateY(0);
  }
}

.card:hover {
  transform: scale(1.04) rotate(-1deg);
}


       
        .hidden {
    display: none;
}
.form-window-container {
    position: relative;
    width: 80%;
    max-width: 600px;
    height: 400px;
    border: 2px solid #5c5c5c;
    background-color: #5c5c5c;
    border-radius: 10px;
    margin: auto;
    margin-top: 50px;
    padding: 20px;
}

.back-button {
    position: absolute;
    top: 10px;
    left: 10px;
    padding: 8px;
    font-size: 1.2rem;
    border: none;
    background-color: #f2f2f2;
    color: #555;
    cursor: pointer;
}

.form-window-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
    padding: 20px;
}

.form-window-content h3 {
    font-size: 2rem;
    margin-bottom: 20px;
}

.form-window-content p {
    font-size: 1.2rem;
    margin-bottom: 30px;
}

.form-window-content form {
    width: 80%;
    max-width: 400px;
}

.form-window-content form button[type="submit"] {
    margin-top: 30px;
    width: 100%;
}
    </style>
    <style>
      table {
          width: 100%;
          border-collapse: collapse;
      }
      th, td {
          border: 1px solid #ccc;
          padding: 8px;
          text-align: left;
      }
      th {
          background-color: #797575;
      }
      tbody tr:nth-child(even) {
          background-color: #585656;
      }
      a {
          color: white;
          text-decoration: none;
      }
      a:hover {
          color: #ccc;
          text-decoration: underline;
      }
      table, th, td, tr, a {
          color: white;
      }
  </style>

    <title>Deposit</title>
</head>
<body>
    <div class="main-container">   
    <div class="custom-container mt-5">
        <h2>Deposit Options</h2>
        <div class="row">
            <div class="col-md-12">
                <h3>Cryptocurrency</h3>
                <div class="row row-cols-3 g-4">
                    <!-- Add more cryptocurrencies in the same format -->
                    <div class="d-flex justify-content-around">
                      <div class="card" onclick="showBSCdepositForm()">
                            <img src="{{ asset('icons/BNB.png') }}" class="img" alt="BNB" width="100" height="100">
                            <div class="card-body">
                                <div class="textbox">
                                    <span>BNB</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around">
                        <div class="card" onclick="showETHdepositForm()">
                            <img src="{{ asset('icons/eth.png') }}" class="img" alt="Ethereum" width="100" height="100">
                            <div class="card-body">
                                <div class="textbox">
                                    <span>Ethereum</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around">
                        <div class="card" onclick="location.href='/withdraw/ltc'">
                            <img src="{{ asset('icons/usdt.png') }}" class="img" alt="USDT" width="100" height="100">
                            <div class="card-body">
                                <div class="textbox">
                                    <span>USDT</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <table>
      <thead>
          <tr>
              <th>Hash</th>
              <th>Value (ETH)</th>
              <th>Value (Coins)</th>
              <th>Date</th>
          </tr>
      </thead>
      <tbody>
          @foreach($deposits as $deposit)
              <tr>
                  <td>
                      @if($deposit->network === 'goerli')
                          <a href="https://goerli.etherscan.io/tx/{{ $deposit->hash }}" target="_blank">{{ $deposit->hash }}</a>
                      @elseif($deposit->network === 'bnb')
                          <a href="https://bscscan.com/tx/{{ $deposit->hash }}" target="_blank">{{ $deposit->hash }}</a>
                      @else
                          {{ $deposit->hash }}
                      @endif
                  </td>
                  <td>{{ $deposit->value }}</td>
                  <td>{{ $deposit->coin_value }}</td>
                  <td>{{ date('Y-m-d H:i:s', $deposit->timestamp) }}</td>
              </tr>
          @endforeach
      </tbody>
  </table>
    <div id="eth-deposit-form" class="hidden">
        <!-- ETH Withdrawal Form Here -->
        <div class="form-window-container">
            <button class="back-button" onclick="hideETHdepositForm()">Back</button>
            <div class="form-window-content">
              <div class="flex flex-col items-center">
                <div class="bg-gray-100 px-4 py-8 rounded-md max-w-md w-full">
                  <h2 class="text-2xl font-semibold mb-4">Deposit</h2>
                  <div class="flex items-center mb-4">
                    <p class="mr-4">{{ auth()->user()->eth_address }}</p>
                    <button class="bg-gray-200 hover:bg-gray-300 py-2 px-4 rounded-md" onclick="copyToClipboard('{{ auth()->user()->eth_address }}')">Copy</button>
                  </div>
                  <div class="bg-white px-4 py-8 rounded-md max-w-md w-full mt-8">
                    <h2 class="text-2xl font-semibold mb-4">Crypto converter</h2>
                    <input type="number" id="coin_value" placeholder="Enter coin value">
                    <div id="eth_value">ETH Value: -</div>

                  </div>
                </div>
              </div>
                </form>
            </div>
        </div>
    </div>
    <div id="eth-deposit-form" class="hidden">
      <!-- ETH Withdrawal Form Here -->
      <div class="form-window-container">
          <button class="back-button" onclick="hideBSCdepositForm()">Back</button>
          <div class="form-window-content">
            <div class="flex flex-col items-center">
              <div class="bg-gray-100 px-4 py-8 rounded-md max-w-md w-full">
                <h2 class="text-2xl font-semibold mb-4">Deposit</h2>
                <div class="flex items-center mb-4">
                  <p class="mr-4">{{ auth()->user()->eth_address }}</p>
                  <button class="bg-gray-200 hover:bg-gray-300 py-2 px-4 rounded-md" onclick="copyToClipboard('{{ auth()->user()->eth_address }}')">Copy</button>
                </div>
                <div class="bg-white px-4 py-8 rounded-md max-w-md w-full mt-8">
                  <h2 class="text-2xl font-semibold mb-4">Crypto converter</h2>
                  <!-- Add your crypto converter code here -->
                </div>
              </div>
            </div>
              </form>
          </div>
      </div>
  </div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBud7LmALD/iT+8E7M/7wi8D7Cfd5KxK5E91eXlNX4ryXVpD" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5jv1wvr5OnKe1mr2Au2jgq3a2CQEvW5t79jF0IC/" crossorigin="anonymous"></script>
</body>
<script>
function showETHdepositForm() {
    
    document.querySelector('.main-container').classList.add('hidden');
    // Remove the cryptocurrency card grid
    document.querySelector('.row-cols-3').classList.add('hidden');
    // Display the ETH withdrawal form
    document.querySelector('#eth-deposit-form').classList.remove('hidden');
}
function hideETHdepositForm() {
    // Hide the ETH withdrawal form
    document.querySelector('#eth-deposit-form').classList.add('hidden');
    // Remove the "hidden" class from the cryptocurrency card grid
    document.querySelector('.row-cols-3').classList.remove('hidden');
    // Display the main container
    document.querySelector('.main-container').classList.remove('hidden');
}

function showBSCdepositForm() {
    
    document.querySelector('.main-container').classList.add('hidden');
    // Remove the cryptocurrency card grid
    document.querySelector('.row-cols-3').classList.add('hidden');
    // Display the ETH withdrawal form
    document.querySelector('#eth-deposit-form').classList.remove('hidden');
}
function hideBSCdepositForm() {
    // Hide the ETH withdrawal form
    document.querySelector('#eth-deposit-form').classList.add('hidden');
    // Remove the "hidden" class from the cryptocurrency card grid
    document.querySelector('.row-cols-3').classList.remove('hidden');
    // Display the main container
    document.querySelector('.main-container').classList.remove('hidden');
}
</script>
<script src="https://cdn.jsdelivr.net/npm/web3@1.6.0/dist/web3.min.js"></script>


<script>
const coinValueInput = document.getElementById('coin_value');
const ethValueDisplay = document.getElementById('eth_value');

coinValueInput.addEventListener('input', function (event) {
    const coinValue = event.target.value;

    fetch('/convert-coins-to-eth?coin_value=' + coinValue)
        .then(response => {
            console.log('Status Code:', response.status); // Log the status code
            console.log('Response:', response); // Log the response object

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const ethValue = data.eth_value;
            ethValueDisplay.textContent = 'ETH Value: ' + ethValue.toFixed(4);
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
});


</script>

@endsection