<?php  
include_once "user/helpper/function.php";
$ip_visitor = $_SERVER['REMOTE_ADDR'];
addVisit($ip_visitor);
?>
<!-- tes -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
      name="description"
      content="Quicqash adalah situs investasi yang membuat anda mendapatkan keuntungan setiap harinya hingga 300%"
    />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="img/favicon.png" type="image/gif" />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />

    <title> </title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark color-theme fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img
            src="img/logo-nav.png"
            alt=""
            width="30"
            height="24"
            class="d-inline-block align-text-top"
          />
          FINACOIN
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto pt-2 pb-2">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
            <a class="nav-link active" href="#sec2">About</a>
            <a class="nav-link active" href="#sec4">Roadmap</a>
            <a class="nav-link active" href="#sec5">Business Plan</a>
            <a class="nav-link active" href="user/auth-register">Register</a>
            <a class="btn btn-warning ms-5" href="user/auth-login">
              Login Account
            </a>
          </div>
        </div>
      </div>
    </nav>
    <!-- Section 1 -->
    <section id="sec1">
      <div class="container">
        <div class="row just">
          <div class="col-12 col-sm-5 me-3 align-self-center">
            <img
              src="img/section1-img2.png"
              class="img-fluid mx-auto d-block"
              alt=""
            />
            <div class="row button-grup">
              <div class="col-6 d-grid">
                <a href="#" class="btn btn-lg btn-success">BUY NOW</a>
              </div>
              <div class="col-6 d-grid">
                <a href="WHITEPAPER.pdf" class="btn btn-lg btn-primary"
                  >WHITE PAPER</a
                >
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 mt-5 mb-3 align-self-center">
            <img
              src="img/section1-img3.png"
              class="img-fluid mx-auto d-block"
              alt=""
            />
          </div>
        </div>
      </div>
    </section>

    <!-- Section 2 -->
    <section id="sec2">
      <div class="container">
        <div class="row">
          <div class="col-12 mb-5">
            <h5>ABOUT</h5>
            <p>--</p>

            <p>
              Fina Coin is a new generation of cryptocurrency, which belongs to
              the utility token family, used and implemented on our platform,
              tokens are developed and maintained for various purposes of
              various industries which include token use, for staking, Mining,
              gaming, and delivery of goods and services.
            </p>
          </div>
          <div class="col-12 mb-5">
            <img
              src="img/finahome.png"
              class="img-fluid mx-auto d-block"
              alt=""
            />
          </div>
        </div>
      </div>
    </section>

    <!-- Section 3 -->
    <section id="sec3">
      <div class="container">
        <div class="row text-center mt-5">
          <div class="col-12 col-sm-4 mb-3">
            <img
              src="img/section3-img1.png"
              alt=""
              class="img-fluid mx-auto d-block mb-5"
            />
            <h4 class="mb-3 text-primary">MINING MACHINE</h4>
            <p>
              FINA COIN has a mining engine to support various aspects of future
              Crypto development programs. This will keep the price of Fina Coin
              stable because the management has the resilience of several crypto
              assets being mined.
            </p>
          </div>
          <div class="col-12 col-sm-4 mb-3">
            <img
              src="img/section3-img2.png"
              alt=""
              class="img-fluid mx-auto d-block mb-5"
            />
            <h4 class="mb-3 text-primary">CEX (DECENTRALIZED EXCHANGER)</h4>
            <p>
              Centralized exchanges (CEX) are the largest types of exchanges of
              the total cryptocurrency exchange, examples of centralized crypto
              exchanges for example are Indodax, Digitalexchange.id, Binance,
              Kraken, Bithumb, ect In centralized exchanges,
            </p>
          </div>
          <div class="col-12 col-sm-4 mb-3">
            <img
              src="img/section3-img4.png"
              alt=""
              class="img-fluid mx-auto d-block mb-5"
            />
            <h4 class="mb-3 text-primary">DEX (DECENTRALIZED EXCHANGER)</h4>
            <p>
              The second type of crypto exchange is a decentralized exchange
              (DEX). Decentralized exchanges do not hold funds (commonly
              referred to as non-custodial) for their users. In contrast,
              transactions or trade agreements are made through smart contracts
              and atomic swaps, so assets never go through an escrow service,
              but run on a pcer-to-peer basis.
            </p>
          </div>
        </div>
      </div>
    </section>
    <!-- Section 4 -->
    <section id="sec4">
      <div class="container">
        <div class="row text-center">
          <div class="col-12 p-3 mb-3">
            <h5>INTERNAL</h5>
            <h1 class="text-primary">ROADMAP</h1>
            <h5>2021</h5>
          </div>
          <div class="col-12 mt-3 mb-3">
            <img
              src="img/roadmap.png"
              class="img-fluid mx-auto d-block"
              alt=""
            />
          </div>
        </div>

        <div class="row text-center mt-5">
          <div class="col-12 p-3 mb-3">
            <h5>HOLD MINIMUM 100 FINA COIN AND GET BNB REWARD</h5>
            <h1 class="text-primary">HOLD TO EARN</h1>
            <hr />
          </div>
          <div class="col-12 mb-3">
            <h6 class="mb-3 text-primary">SPECIFICATION</h6>
            <div class="row mb-2">
              <div class="col tab-info">TOKEN NAME</div>
              <div class="col tab-info">FINA COIN</div>
            </div>
            <div class="row mb-2">
              <div class="col tab-info">ABBREVATION</div>
              <div class="col tab-info">FINA COIN</div>
            </div>
            <div class="row mb-2">
              <div class="col tab-info">TOTAL SUPPLY</div>
              <div class="col tab-info">20.000.000 FINA COIN</div>
            </div>
            <div class="row">
              <div class="col tab-info">
                Smart Contract : <br />Ox22d5f75a078f8153836d
                13e7c56e81d089b6202d
              </div>
            </div>
          </div>

          <div class="col-12">
            <h6 class="mb-3 text-primary">TOKENOMIC</h6>
            <div class="row mb-2">
              <div class="col tab-info">TAX</div>
              <div class="col tab-info">10%</div>
            </div>
            <div class="row mb-2">
              <div class="col tab-info">EARN BNB</div>
              <div class="col tab-info">7%</div>
            </div>
            <div class="row mb-2">
              <div class="col tab-info">MARKETING</div>
              <div class="col tab-info">3%</div>
            </div>
          </div>
          <div class="col-12 p-3 mb-3">
            <div class="table-responsive-sm">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">AMMOUNT</th>
                    <th>PLACEMENT</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>5.000.000 (25%)</td>
                    <td>Saving Developer</td>
                  </tr>
                  <tr>
                    <td>5.000.000 (25%)</td>
                    <td>Sale Internal</td>
                  </tr>
                  <tr>
                    <td>5.000.000 (25%)</td>
                    <td>Affiliate Internal</td>
                  </tr>
                  <tr>
                    <td>5.000.000 (25%)</td>
                    <td>External Market</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Section 5 -->
    <section id="sec5">
      <div class="container">
        <div class="row text-center">
          <div class="col-12 col-sm-4 mb-3">
            <h5 class="text-primary mb-2">FINA OPEN PRICE</h5>
            <img
              src="img/section5-img-1.png"
              class="img-fluid mx-auto d-block mb-2"
              alt=""
            />
            <div class="text-center">
              <p>
                Pre Sell : <span class="text-primary"><b>$1</b></span>
                <br />
                External Target Price :
                <span class="text-primary"><b>$10</b></span>
              </p>
            </div>
          </div>

          <div class="col-12 col-sm-4 mb-3">
            <h5 class="text-primary mb-2">HOW TO JOIN</h5>
            <img
              src="img/section5-img-2.png"
              class="img-fluid mx-auto d-block mb-2"
              alt=""
            />
            <div class="text-center">
              <p>
                Buy Voucher
                <span class="text-primary"><b>$10</b></span> (one for all)
                <br />
                Buy FNC on
                <span class="text-primary"><b> internal exchange</b></span>
              </p>
            </div>
          </div>

          <div class="col-12 col-sm-4 mb-3">
            <h5 class="text-primary mb-2">PROJECT OF FNC</h5>
            <img
              src="img/section5-img-3.png"
              class="img-fluid mx-auto d-block mb-2"
              alt=""
            />
            <div class="text-center">
              <p>
                Mining Mechine
                <br />
                Own DEX <span class="text-primary"><b>(external marke</b></span>
                <br />
                Own CEX
                <span class="text-primary"><b>(external market)</b></span>
                <br />
                Merchant Soon
                <br />
                PPOB Tour & Travel
                <br />
                Online Transportation
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="sec6">
      <div class="container text-center mb-5">
        <h5 class="mb-3">PARTNERSHIP</h5>
        <p>--</p>
        <div class="row mb-3">
          <div class="col-4 col-sm-4">
            <img
              src="img/logo-binance.png"
              class="img-fluid mx-auto d-block"
              alt=""
            />
          </div>
          <div class="col-4 col-sm-4">
            <img
              src="img/logo-bscscan.png"
              class="img-fluid mx-auto d-block"
              alt=""
            />
          </div>
          <div class="col-4 col-sm-4">
            <img
              src="img/logo-pancakeswap.png"
              class="img-fluid mx-auto d-block"
              alt=""
            />
          </div>
        </div>
        <div class="row">
          <div class="col-4 col-sm-4">
            <img
              src="img/logo-coinegko.png"
              class="img-fluid mx-auto d-block"
              alt=""
            />
          </div>
          <div class="col-4 col-sm-4">
            <img
              src="img/logo-cointiger.png"
              class="img-fluid mx-auto d-block"
              alt=""
            />
          </div>
          <div class="col-4 col-sm-4">
            <img
              src="img/logo-coinmarketcap.png"
              class="img-fluid mx-auto d-block"
              alt=""
            />
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <section id="footer">
      <div class="container">
        <div class="row">
          <div class="col-6 col-sm-10">
            <img src="img/logo-footer.png" class="img-fluid d-block" alt="" />
          </div>

          <div class="col-6 col-sm-2">
            <div class="mb-6">
              <a href="https://twitter.com/finacoin">
                <img src="img/ic-twitter.png" alt="" /> finacoin</a
              >
            </div>
            <div class="mb-2">
              <a href="https://instagram.com/fina_coin">
                <img src="img/ic-ig.png" alt="" /> fina_coin</a
              >
            </div>
            <div class="mb-2">
              <a href="https://tiktok.com/fina_coin">
                <img src="img/ic-tiktok.png" alt="" /> fina_coin</a
              >
            </div>
            <div class="mb-2">
              <a href="https://twitter.com/finacoin">
                <img src="img/ic-yt.png" alt="" /> finacoin</a
              >
            </div>
            <div class="mb-2">
              <a href="https://facebook.com/finacoin">
                <img src="img/ic-fb.png" alt="" /> fina coin</a
              >
            </div>
          </div>
          <hr style="color: #fff" class="mt-2" />
          <div class="col-12 text-center mt-3">
            <p class="p-footer">
              @2021 Copyright <a href="index.html"><b>FINACOIN</b></a>
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
