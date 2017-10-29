<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	 	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>TechFreak</title>
		<!-- <link href="../../dist/css/bootstrap.min.css" rel="stylesheet"> -->
		<link href="./css/bootstrap.min.css" rel="stylesheet">
		<link href="./css/style.css" rel="stylesheet">
		<!-- <link rel="stylesheet" href="./css/bulma.css"> -->
		<!-- <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script> -->
		<script src="./js/scrollreveal.js"></script>
		<script src="./js/vue.js"></script>


		<!-- <link href="./styles.css" rel="stylesheet"> -->
	</head>
	<body>
		<div id="app">
			<header id=showcase>
				<h1><strong>Welcome to the math Corner</strong></h1>
				<p>We will have some fun calculating easy mathematic concepts, like prime factors, roman numbers, fibinachi numbers and factorial of a number.
					i hope you will find them usefull and play with them.</p>
				<a href="#" class="button"><strong>Read More</strong></a>

			</header>
			<?php
			function fibonacci($pos)
			{
				$fibarray = array(0, 1);
				for ( $i=2; $i<=$pos; ++$i )
				{
					$fibarray[$i] = $fibarray[$i-1] + $fibarray[$i-2];
				}
			 return $fibarray;
			}

			?>


			<section id="section-a">
					<h1>Please give me a natural number greater than 2 and less than 5000 and then choose what you want to do with it.</h1>

			</section>

			<div class="row" id="input" style="background: #926239">
				<div class="col-md-2 col-md-offset-5">
					<input type="number" name="gnumber" v-bind:title="instructions" v-model="gnumber">
					<br>
				</div>
			</div>

			<div class="row" id="buttons" style="background: #926239">
				<div class="col-md-3 col-md-offset-2">
					<button class="btn btn-danger" name="button" @click="findAllPrimes(gnumber)" style="margin-top: 10px" >Analyze the number to prime factors</button>
				</div>
				<div class="col-md-3">
					<button class="btn btn-primary" name="button" @click="primesLessThanGnumber(gnumber)" style="margin-top: 10px" >All Primes smaller than given number.</button>
				</div>
				<div class="col-md-3">
					<button class="btn btn-danger" name="button" @click="convert(gnumber)" style="margin-top: 10px" >Convert the number to Roman</button>
				</div>


			</div>






				<section id="section-b">
						<div class="row">
							<div class="col-md-8 col-md-offset-2">
								<ul>
									<li>If you want to analyze a number to prime factors just choose a positive greater than 2.</li>
									<li>if you want to find all the primes that are less than given number please choose a positive greater than 3 and smaller than 5000.</li>
									<li>if you want to convert a number to Roman choose him between 1 and 5000.</li>
								</ul>
							</div>
						</div>
				</section>


			<section id="section-c">
				<div class="row">
					<div id="box1" class="box1 col-md-4" style="padding:20px" >
						<h3 v-cloak>The analyze of {{oldNumber}} into prime factors is:</h3>
						<span v-cloak v-for="(prime, index) in primes">
							<span v-cloak><strong>{{prime}}</strong></span><span v-if="index<primesLen-1"><strong>*</strong> </span>
						</span>

					</div>
					<div id="box2" class="box2 col-md-4" style="padding:20px">
							<h3>All the prime numbers that are less than {{oldNumber2}} are: </h3>
						<span v-for="(prime, index) in allPrimes">
							<span>{{prime}}</span>
							<span v-if="index < allPrimesLen-1">,</span>
						</span>
					</div>

					<div id="box3" class="box3 col-md-4" style="padding:20px">
						<h3>The Roman represantasion of your {{oldNumber3}} is: {{solution}} </h3>
					</div>
				</div>
			</section>
		</div>

		<footer id="footer">
			<p class="text-center">TechFreak Copyright &copy; 2017</p>
		</footer>


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.js"
  				integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  				crossorigin="anonymous"></script>
		<!-- <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script> -->
		<!-- <script src="../../dist/js/bootstrap.min.js"></script> -->
		<script src="./js/bootstrap.min.js"></script>

		<script>

			var app=new Vue({
			  // element to mount to
			  el: '#app',
			  // initial data
			  data: {
						instructions: 'Read the instuctions below in order to give a number!',
						gnumber: 0,
						oldNumber: 0,
						oldNumber2: 0,
						oldNumber3: 0,
						primes: [],
						allPrimes:[],
						primesLen: 0,
						allPrimesLen: 0,
						limit:[
							1000,
							900,
							500,
							400,
							100,
							90,
							50,
							40,
							10,
							9,
							5,
							4,
							1
						],
						glyph: [
							'M',
							'CM',
							'D',
							'CD',
							'C',
							'XC',
							'L',
							'XL',
							'X',
							'IX',
							'V',
							'IV',
							'I'
						],
						solution: ''
				},
			  // computed property for form validation state
			  computed:
				{
					passTheNumber: function ()
					{
						// this.allPrimes=[];
						// return this.allPrimes=findAllPrimes(this.gnumber);
					}

				},
				methods:
				{
					findAllPrimes: function (number)
					{
						if (number<2 || number > 5000)
						{
							var w = window.open('','','width=500,height=200,left=375,top=330')
							w.document.write('Please give a number between 2 and 5000')
							w.focus()
							setTimeout(function() {w.close();}, 5000)
							// alert('Please give a number between 2 and 5000');
							throw new InvalidArgumentException;
							return
						}

						this.primes = [];
						this.primesLen = 0;
						var candidate = 2;
						var gnumber = this.gnumber;
						for (candidate = 2; gnumber > 1; candidate++)
						{
							for (; gnumber % candidate == 0; gnumber /= candidate)
							{
								this.primes.push(candidate);
								this.primesLen++;
							}
						}
						gnumber = 0;
						this.oldNumber = this.gnumber;
						return this.primes;
					},
					isPrime: function (number)
					{
						var candidate = 2;
						if (number == 2)
							{
								return true;
							}
							for (candidate = 2; candidate < (number/2)+1; candidate++)
							{
								if (number % candidate == 0)
								{
									return false;
								}
							}
							return true;
						},
					primesLessThanGnumber: function(number)
					{
						if (number<3 || number > 5000)
						{
							alert('Please give a number between 3 and 5000');
							throw new InvalidArgumentException;
							return
						}

						var i = 2;
						this.allPrimes = [];
						this.allPrimesLen = 0;
						for (i=2; i < number; i++)
						{
							if (this.isPrime(i))
							{
								this.allPrimes.push(i);
								this.allPrimesLen++;
							}
						}
						this.oldNumber2 = this.gnumber;
					},
					convert: function(number)
					{
						if (number<=0 || number > 5000)
						{
							alert('Please give a number between 1 and 5000');
							throw new InvalidArgumentException;
							return
						}
						this.solution = '';
						var i=0;
						for (i=0; i<13; i++)
						{
							while (number >= this.limit[i])
							{
								this.solution += this.glyph[i];
								number -= this.limit[i];
							}
						}
						this.oldNumber3 = this.gnumber;
						return this.solution;
						}
				}
			})

		</script>


		<script>
			window.sr = ScrollReveal();
			sr.reveal('#box1', {
			  duration: 3000,
			  origin:'left',
			  distance:'300px'
			//   viewFactor: 0.2
			});
			sr.reveal('#box2', {
			  duration: 3000,
			  origin:'top',
			  delay: 3000,
			  distance:'300px'
			//   viewFactor: 0.2
			});
			sr.reveal('#box3', {
			  duration: 3000,
			  origin:'right',
			  distance:'300px'
			//   viewFactor: 0.1
			});
			sr.reveal('#footer', {
				duration: 3000,
				origin:'bottom',
				delay: 3000,
				distance:'300px'
			});

		</script>

	</body>
</html>
