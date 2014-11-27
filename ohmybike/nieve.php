<script language='javascript' type='text/javascript'>
	//<![CDATA[
	// Nevando en la pagina por Eloi Gallés Villaplana
	// Adaptado a navegadores DOM por Iván Nieto - junio 2007

	var numero = 16
	var velocidad = 4
	var imagennieve = "http://i1081.photobucket.com/albums/j345/dennis_yeah/test_zps4a64c11c.png"

	var ns4arriba = (document.layers) ? 1 : 0
	var ie4arriba = (document.all) ? 1 : 0
	var dombrowser = (document.getElementById) ? 1 : 0

	var dx, xp, yp
	var am, stx, sty
	var i, doc_ancho = 1024, doc_alto = 768

	function nieva() {

		establece_dimensiones()

		dx = new Array()
		xp = new Array()
		yp = new Array()
		am = new Array()
		stx = new Array()
		sty = new Array();
	     
		for (i = 0; i < numero; ++ i) {
			dx[i] = 0
			xp[i] = Math.random()*(doc_ancho-50)
			yp[i] = Math.random()*doc_alto
			am[i] = Math.random()*20
			stx[i] = 0.02 + Math.random()/10
			sty[i] = 0.7 + Math.random()
			if (document.layers) {
	     			if (i == 0) {
					document.write("<layer name=\"dot"+ i +"\" left=\"15\" ")
					document.write("top=\"15\" visibility=\"show\"><img src=\"")
					document.write(imagennieve + "\" border=\"0\"></layer>")
	     			} else {
	     				document.write("<layer name=\"dot"+ i +"\" left=\"15\" ")
	     				document.write("top=\"15\" visibility=\"show\"><img src=\"")
	     				document.write(imagennieve + "\" border=\"0\"></layer>")
	     			}
	     		} else if (document.all || document.getElementById) {
	     			if (i == 0) {
	     				document.write("<div id=\"dot"+ i +"\" style=\"POSITION: ")
	     				document.write("absolute; Z-INDEX: "+ i +"; VISIBILITY: ")
	     				document.write("visible; TOP: 15px; LEFT: 15px;\"><img src=\"")
	     				document.write(imagennieve + "\" border=\"0\"></div>")
	     			} else {
	     				document.write("<div id=\"dot"+ i +"\" style=\"POSITION: ")
	     				document.write("absolute; Z-INDEX: "+ i +"; VISIBILITY: ")
	     				document.write("visible; TOP: 15px; LEFT: 15px;\"><img src=\"")
	     				document.write(imagennieve + "\" border=\"0\"></div>")
	     			}
	     		}
	     }
	     
		nieve()
	}

	function nieve() {
		for (i = 0; i < numero; ++ i) {
			yp[i] += sty[i];
			if (yp[i] > doc_alto) {
				xp[i] = Math.random()*(doc_ancho-am[i]-30)
				yp[i] = 0
				stx[i] = 0.02 + Math.random()/10
				sty[i] = 0.7 + Math.random()
				establece_dimensiones()
			}

			dx[i] += stx[i];

			
			if ( document.all ) {
				var copo = eval("dot" + i )
				copo.style.posLeft = xp[i] + am[i]*Math.sin(dx[i])
				copo.style.posTop = yp[i]
			}
			
			else if ( document.layers ) {
				var copo = eval("document.dot" + i)
				copo.left = xp[i] + am[i]*Math.sin(dx[i])
				copo.top = yp[i]
			}
			
			else if ( document.getElementById ) {
				var copo = document.getElementById( "dot" + i)
				copo.style.left = xp[i] + am[i]*Math.sin(dx[i]) + 'px'
				copo.style.top = yp[i] + 'px'
			}
		}

		setTimeout("nieve()", velocidad)
	}
	function establece_dimensiones() {
		if (self.innerHeight) {
			doc_ancho = self.innerWidth
			doc_alto = self.innerHeight - 25
		} else if (document.documentElement && document.documentElement.clientHeight) {
			doc_ancho = document.documentElement.clientWidth
			doc_alto = document.documentElement.clientHeight - 25
		
		} else if (document.body) {
			doc_ancho = document.body.clientWidth
			doc_alto = document.body.clientHeight - 25
		}
	}
	//]]>
</script> 

<script language='javascript' type='text/javascript'>
	nieva()
</script>
