	var background="rgb(255,255,255)";
	var text= "rgb(0,0,0)";
	var taille = 1;			
	var incTaille = .2;
	var interligne=1;	
	var incInterligne= .1;
	var espaceCaractere=0;			
	var incEspaceCaractere=.1;
	var espaceMot = .1;	
	var incEspaceMot = .1;
	var font='Helvetica';
	var bold=0;
	var italic=0;
	var police='default';
	var x=null;
	
		// Here we can adjust defaults for all color pickers on page:
	jscolor.presets.default = {
		palette: [
			'#000000', '#7d7d7d', '#870014', '#ec1c23', '#ff7e26', '#fef100', '#22b14b', '#00a1e7', '#3f47cc', '#a349a4',
			'#ffffff', '#c3c3c3', '#b87957', '#feaec9', '#ffc80d', '#eee3af', '#b5e61d', '#99d9ea', '#7092be', '#c8bfe7',
		],
		//paletteCols: 12,
		//hideOnPaletteClick: true,
		//width: 271,
		//height: 151,
		//position: 'right',
		//previewPosition: 'right',
		//backgroundColor: 'rgba(51,51,51,1)', controlBorderColor: 'rgba(153,153,153,1)', buttonColor: 'rgba(240,240,240,1)',
		closeButton:'true', 
		closeText:'Fermer',
		hideOnPaletteClick:'true',
		hideOnLeave:'true',
	}
	
	// Set values to cookies.
	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		var expires = "expires=" + d.toUTCString();
		document.cookie = cname + '=' + cvalue + '; ' + expires + '; path=/ ';
		//javascript:window.location.reload();
	}


	// Get value from cookies.
	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) === 0) {
				return c.substring(name.length,c.length);
			}
		}
		return "";
	}


	// met a jour la couleur de fond
	function updateBackground(picker) {
		background=picker.toRGBString();
		setBackground(background);
		recap();
	}

	// applique la couleur de fond
	function setBackground(RGB) {
		document.body.style.background = RGB;
		var all = document.getElementsByTagName("*");
		for (var i=0, max=all.length; i < max; i++) 
		{
			if (all[i].name != 'couleur_du_texte')
				all[i].style.background = RGB;
		}
		for (const element of document.getElementsByClassName(".editor_atto_content"))
		{
			element.style.background = RGB;
		}
		//document.getElementsById("page-footer").style.background = RGB;
	}

	// met à jour la couleur du texte
	function updateTextColor(picker) {
		text=picker.toRGBString()
		setTextColor(text);
		recap();
	}

	// applique la couleur du texte
	function setTextColor(RGB) {

		// document.body.style.color = RGB;
		var all = document.getElementsByTagName("*");
		for (var i=0, max=all.length; i < max; i++) {
			all[i].style.color = RGB;
		}
	}	

	// change la taille du texte
	function changerTaille(modif) {
		taille = taille + modif*incTaille;
		setTaille(taille);
		recap();
	}

	// applique la taille du texte
	function setTaille(taille) {
		document.getElementsByTagName("body")[0].style.fontSize = taille + "em";		
	} 	

	// change l'interligne
	function changerInterligne(modif) {
		interligne = interligne + modif *incInterligne;
		setInterligne(interligne);
		recap();
	}
	
	// applique l'interligne
	function setInterligne(interligne)
	{
		document.getElementsByTagName("body")[0].style.lineHeight = interligne + "em";		
	} 	

	// change l'espace entre les caractères
	function changerEspaceCaractere(modif) {
		espaceCaractere = espaceCaractere + modif * incEspaceCaractere;
		setEspaceCaractere(espaceCaractere);
		recap();
	}
	
	// applique l'espace entre les caractères
	function setEspaceCaractere(espaceCaractere) {
		document.getElementsByTagName("body")[0].style.letterSpacing = espaceCaractere + "em";		
	} 	

	// change  l'espace entre les mots
	function changerEspaceMot(modif) {
		espaceMot = espaceMot + modif * incEspaceMot;
		setEspaceMot(espaceMot);
		recap();
	}
	
	// applique l'espace entre les mots
	function setEspaceMot(espaceMot) {
		document.getElementsByTagName("body")[0].style.wordSpacing = espaceMot + "em";		
	} 	
	function changerPolice(lpolice)
	{
		police=lpolice;
		setPolice(police);
		recap();
	}
	function changerBold()
	{
		if (bold == 1)	
		{
			bold = 0;
		}
		else	
		{
			bold = 1;
		}
		setPolice(police);
		recap();
	}
	function changerItalic()
	{
		if (italic == 1)	
		{
			italic = 0;
		}
		else	
		{
			italic = 1;
		}
		setPolice(police);
		recap();
	}
	
	// change la police de caractères
	function setPolice(police) {
		if (x != null)
			document.head.removeChild(x);
		x = document.createElement("STYLE");
		if (police == 'default')
		{
			if (bold==1 && italic==1)
			{
				var t = document.createTextNode("\
					body,h1,h2,h3,h4,h5,h6,p,ul,ol,dl,input,textarea \
						{font-family: inherit; \
						font-style: italic; \
						font-weight: bold; \
						} \
					select \
						{font-family: inherit; \
						font-style: italic; \
						font-weight: bold; \
						box-sizing: content-box;} \
					\
					");
			}
			else
				if (bold==1)
				{
					var t = document.createTextNode("\
						body,h1,h2,h3,h4,h5,h6,p,ul,ol,dl,input,textarea \
							{font-family: inherit; \
							font-weight: bold; \
							} \
						select \
							{font-family: inherit; \
							font-weight: bold; \
							box-sizing: content-box;} \
						\
						");
				}
				else
					if (italic==1)
					{
						var t = document.createTextNode("\
								body,h1,h2,h3,h4,h5,h6,p,ul,ol,dl,input,textarea \
									{font-family: inherit; \
									font-style: italic; \
									} \
								select \
									{font-family: inherit; \
									font-style: italic; \
									box-sizing: content-box;} \
								\
								");
					}
					else
					{
						var t = document.createTextNode("\
							body,h1,h2,h3,h4,h5,h6,p,ul,ol,dl,input,textarea \
								{font-family: inherit; \
								} \
							select \
								{font-family: inherit; \
								box-sizing: content-box;} \
							\
							");
					}
			x.appendChild(t);
		}
		else
		{
			if (bold==1 && italic==1)
				var t = document.createTextNode("\
					body,h1,h2,h3,h4,h5,h6,p,ul,ol,dl,input,textarea \
						{font-family: "+police+"; \
						font-style: italic; \
						font-weight: bold; \
						} \
					select \
						{font-family: "+police+"; \
						font-style: italic; \
						font-weight: bold; \
						box-sizing: content-box;} \
					\
					");
			else
				if (bold==1)
					var t = document.createTextNode("\
						body,h1,h2,h3,h4,h5,h6,p,ul,ol,dl,input,textarea \
							{font-family: "+police+"; \
							font-weight: bold; \
							} \
						select \
							{font-family: "+police+"; \
							font-weight: bold; \
							box-sizing: content-box;} \
						\
						");
				else
					if (italic==1)
						var t = document.createTextNode("\
							body,h1,h2,h3,h4,h5,h6,p,ul,ol,dl,input,textarea \
								{font-family: "+police+"; \
								font-style: italic; \
								} \
							select \
								{font-family: "+police+"; \
								font-style: italic; \
								box-sizing: content-box;} \
							\
							");
					else
						var t = document.createTextNode("\
							body,h1,h2,h3,h4,h5,h6,p,ul,ol,dl,input,textarea \
								{font-family: "+police+"; \
								} \
							select \
								{font-family: "+police+"; \
								box-sizing: content-box;} \
							\
							");
			x.appendChild(t);
		}
		document.head.appendChild(x);
		font=police;
	}
	
	// mis à jour du champ texte et du cookie
	function recap() {
		var texte="";
//		config = getCookie('accessibilite');
//		if (config!='')
//		{
		texte=background+':'+text+':'+taille+':'+interligne+':'+espaceCaractere+':'+espaceMot+':'+font+':'+bold+':'+italic;
//		}
		document.getElementsByName('block_accessibilite_code')[0].value=texte;
//		document.getElementsByName('block_accessibilite_code')[0].value=texte;
		setCookie('accessibilite',texte,30);
	}
	
	// initialise les données par la lecture du cookie
	function init() {
/*		config = getCookie('accessibilite');
		if (config!='')
		{
			res=config.split(':');
			background=res[0];
			text=res[1];
			taille=parseFloat(res[2],10);
			interligne=parseFloat(res[3],10);
			espaceCaractere=parseFloat(res[4],10);
			espaceMot=parseFloat(res[5],10);
			police=res[6];
			bold=res[7];
			italic=res[8];
			setConfig();
			recap();
		}
		else
		{
*/			var elementcode=document.getElementById('accessibilite-code');
			config =elementcode.dataset.code
			if (config!='')
			{
				res=config.split(':');
				background=res[0];
				text=res[1];
				taille=parseFloat(res[2],10);
				interligne=parseFloat(res[3],10);
				espaceCaractere=parseFloat(res[4],10);
				espaceMot=parseFloat(res[5],10);
				police=res[6];
				bold=res[7];
				italic=res[8];
				setConfig();
				recap();
			}
			else
			{
				background='rgb(255,255,255)';
				text='rgb(0,0,0)';
				taille=1;
				interligne=1;
				espaceCaractere=0;
				espaceMot=.1;
				police='helvetica';
				bold=0;
				italic=0;
			}
//		}
	}
	
	function RAZ() {
		background='rgb(255,255,255)';
		text='rgb(0,0,0)';
		taille=1;
		interligne=1;
		espaceCaractere=0;
		espaceMot=.1;
		police='default';
		bold=0;
		italic=0;
		setConfig();
		document.getElementsByName('block_accessibilite_code')[0].value='';
		setCookie('accessibilite','',0);
		//TODO
		location.reload();
	}
	
	function AppliquerValeur() {
		config=document.getElementsByName('block_accessibilite_code')[0].value;
		res=config.split(':');
		background=res[0];
		text=res[1];
		taille=parseFloat(res[2],10);
		interligne=parseFloat(res[3],10);
		espaceCaractere=parseFloat(res[4],10);
		espaceMot=parseFloat(res[5],10);
		police=res[6];
		bold=res[7];
		italic=res[8];
		setConfig();
		recap();
	}
	function setConfig() {
		setBackground(background);
		setTextColor(text);
		setTaille(taille);
		setInterligne(interligne);
		setEspaceCaractere(espaceCaractere);
		setEspaceMot(espaceMot);
		setPolice(police);
	}
	
	init();
	
	
