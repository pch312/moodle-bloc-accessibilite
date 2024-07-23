
	var block_accessibilite_background="rgb(255,255,255)";
	var block_accessibilite_text= "rgb(0,0,0)";
	var block_accessibilite_taille = 1;			
	var block_accessibilite_incTaille = .2;
	var block_accessibilite_interligne=1;	
	var block_accessibilite_incInterligne= .1;
	var block_accessibilite_espaceCaractere=0;			
	var block_accessibilite_incEspaceCaractere=.1;
	var block_accessibilite_espaceMot = .1;	
	var block_accessibilite_incEspaceMot = .1;
	var block_accessibilite_font='Helvetica';
	var block_accessibilite_bold=0;
	var block_accessibilite_italic=0;
	var block_accessibilite_police='default';
	var block_accessibilite_couleur1=''
	var block_accessibilite_couleur2=''
	var block_accessibilite_altern=0;
	var block_accessibilite_mono=0;
	var block_accessibilite_num_cursor = 0;

	var block_accessibilite_x=null;
	
	var block_accessibilite_mask_posY=0;
	var block_accessibilite_mask_lastScrolledTop=0;
	var block_accessibilite_mask_delta=40;
		
	var block_accessibilite_style = document.createElement('style');
	document.head.appendChild(block_accessibilite_style);
	
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
	function block_accessibilite_setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		var expires = "expires=" + d.toUTCString();
		document.cookie = cname + '=' + cvalue + '; ' + expires + '; path=/ ' + '; samesite=strict';
		//javascript:window.location.reload();
	}


	// Get value from cookies.
	function block_accessibilite_getCookie(cname) {
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
	function block_accessibilite_updateBackground(picker) {
		block_accessibilite_background=picker.toRGBString();
		block_accessibilite_setBackground(block_accessibilite_background);
		block_accessibilite_recap();
	}

	// applique la couleur de fond
	function block_accessibilite_setBackground(RGB) {
		document.body.style.background = RGB;
		
		var all = document.getElementsByTagName("*");
		
		for (var i=0, max=all.length; i < max; i++) 
		{
			if ((all[i].name != 'couleur_du_texte') 
				&& ( ! all[i].className.includes('collaboration')) 
				&& ( ! all[i].className.includes('content')) 
				&& ( ! all[i].className.includes('assessment')) 
				&& ( ! all[i].className.includes('communication')) 
				&& ! ( (all[i].tagName=='IMG') && all[i].parentElement.className.includes('collaboration'))
				&& ! ( (all[i].tagName=='IMG') && all[i].parentElement.className.includes('content'))
				&& ! ( (all[i].tagName=='IMG') && all[i].parentElement.className.includes('assessment'))
				&& ! ( (all[i].tagName=='IMG') && all[i].parentElement.className.includes('communication'))
				)
			{
				all[i].style.background = RGB;
			}
		}
		for (const element of document.getElementsByClassName(".editor_atto_content"))
		{
			element.style.background = RGB;
		}
		//document.getElementsById("page-footer").style.background = RGB;
	}

	// met à jour la couleur du texte
	function block_accessibilite_updateTextColor(picker) {
		block_accessibilite_text=picker.toRGBString()
		block_accessibilite_setTextColor(block_accessibilite_text);
		block_accessibilite_recap();
	}

	// applique la couleur du texte
	function block_accessibilite_setTextColor(RGB) {

		// document.body.style.color = RGB;
		var all = document.getElementsByTagName("*");
		for (var i=0, max=all.length; i < max; i++) {
			all[i].style.color = RGB;
		}
	}	

	// change la taille du texte
	function block_accessibilite_changerTaille(modif) {
		block_accessibilite_taille = block_accessibilite_taille + modif*block_accessibilite_incTaille;
		block_accessibilite_setTaille(block_accessibilite_taille);
		block_accessibilite_recap();
	}

	// applique la taille du texte
	function block_accessibilite_setTaille(taille) {
		document.getElementsByTagName("body")[0].style.fontSize = taille + "em";		
	} 	

	// change l'interligne
	function block_accessibilite_changerInterligne(modif) {
		block_accessibilite_interligne = block_accessibilite_interligne + modif *block_accessibilite_incInterligne;
		block_accessibilite_setInterligne(block_accessibilite_interligne);
		block_accessibilite_recap();
	}
	
	// applique l'interligne
	function block_accessibilite_setInterligne(interligne)
	{
		document.getElementsByTagName("body")[0].style.lineHeight = interligne + "em";		
	} 	

	// change l'espace entre les caractères
	function block_accessibilite_changerEspaceCaractere(modif) {
		block_accessibilite_espaceCaractere = block_accessibilite_espaceCaractere + modif * block_accessibilite_incEspaceCaractere;
		block_accessibilite_setEspaceCaractere(block_accessibilite_espaceCaractere);
		block_accessibilite_recap();
	}
	
	// applique l'espace entre les caractères
	function block_accessibilite_setEspaceCaractere(espaceCaractere) {
		document.getElementsByTagName("body")[0].style.letterSpacing = espaceCaractere + "em";		
	} 	

	// change  l'espace entre les mots
	function block_accessibilite_changerEspaceMot(modif) {
		block_accessibilite_espaceMot = block_accessibilite_espaceMot + modif * block_accessibilite_incEspaceMot;
		block_accessibilite_setEspaceMot(block_accessibilite_espaceMot);
		block_accessibilite_recap();
	}
	
	// applique l'espace entre les mots
	function block_accessibilite_setEspaceMot(espaceMot) {
		document.getElementsByTagName("body")[0].style.wordSpacing = espaceMot + "em";		
	} 	
	function block_accessibilite_changerPolice(lpolice)
	{
		block_accessibilite_police=lpolice;
		block_accessibilite_setPolice(block_accessibilite_police);
		block_accessibilite_recap();
	}
	function block_accessibilite_changerBold()
	{
		if (block_accessibilite_bold == 1)	
		{
			block_accessibilite_bold = 0;
		}
		else	
		{
			block_accessibilite_bold = 1;
		}
		block_accessibilite_setPolice(block_accessibilite_police);
		block_accessibilite_recap();
	}
	function block_accessibilite_changerItalic()
	{
		if (block_accessibilite_italic == 1)	
		{
			block_accessibilite_italic = 0;
		}
		else	
		{
			block_accessibilite_italic = 1;
		}
		block_accessibilite_setPolice(block_accessibilite_police);
		block_accessibilite_recap();
	}
	
	// change la police de caractères
	function block_accessibilite_setPolice(police) {
		if (block_accessibilite_x != null)
			document.head.removeChild(block_accessibilite_x);
		block_accessibilite_x = document.createElement("STYLE");
		if (police == 'default')
		{
			if (block_accessibilite_bold==1 && block_accessibilite_italic==1)
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
				if (block_accessibilite_bold==1)
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
					if (block_accessibilite_italic==1)
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
			block_accessibilite_x.appendChild(t);
		}
		else
		{
			if (block_accessibilite_bold==1 && block_accessibilite_italic==1)
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
				if (block_accessibilite_bold==1)
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
					if (block_accessibilite_italic==1)
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
			block_accessibilite_x.appendChild(t);
		}
		document.head.appendChild(block_accessibilite_x);
		block_accessibilite_font=police;
	}
	

	function block_accessibilite_monochrome()
	{
		if (block_accessibilite_mono==1)
			block_accessibilite_mono = 0;
		else
			block_accessibilite_mono = 1; 
      	var body = document.body;
      	body.classList.toggle("monochrome");
      	block_accessibilite_recap();
	}
	
		// met a jour la couleur de texte 1
	function block_accessibilite_updateColor1(picker) {
		block_accessibilite_couleur1=picker.toRGBString();
	}

		// met a jour la couleur de texte 2
	function block_accessibilite_updateColor2(picker) {
		block_accessibilite_couleur2=picker.toRGBString();
	}

	function block_accessibilite_alterncolor()
	{
		let derniereCouleur = block_accessibilite_couleur1;

	    function parcourirEtStyliser(element) {
			
			if (element.hasChildNodes()) {
		       		element.childNodes.forEach(function(child) {
		            parcourirEtStyliser(child);
		        });
		    } else if (element.nodeType === Node.TEXT_NODE) { // Utilisation de Node.TEXT_NODE
		        if (element.textContent.trim() !== '') {
		            let mots = element.textContent.split(' '); // Conserver les espaces tels quels
		            let nouveauContenu = '';
		            mots.forEach(function(mot, index) {
						  let couleur = derniereCouleur = (derniereCouleur === block_accessibilite_couleur1) ? block_accessibilite_couleur2 : block_accessibilite_couleur1;
		                //let couleur = (index % 2 === 0) ? 'red' : 'blue';
		                if (mot !== '') {
		                    mot = `<span style="color: ${couleur};">${mot}</span>`;
		                }
		                nouveauContenu += mot + (index < mots.length - 1 ? ' ' : ''); // Gestion des espaces
		            });
		            let tempDiv = document.createElement('div');
		            tempDiv.innerHTML = nouveauContenu; // Pas de .trim()
		            while (tempDiv.firstChild) {
		                element.parentNode.insertBefore(tempDiv.firstChild, element);
		            }
		            element.parentNode.removeChild(element);
		        }
		    }
	    }
	
	    parcourirEtStyliser(document.body);
	    if (block_accessibilite_altern==1)
			block_accessibilite_altern = 0;
		else
			block_accessibilite_altern = 1; 

		block_accessibilite_recap();
	}
	
		


	function block_accessibilite_changeCursor(parametre)
	{
		block_accessibilite_num_cursor++;
		if (parametre != undefined) {
			block_accessibilite_num_cursor = parametre;
		}		
	
		while (block_accessibilite_style.sheet.cssRules.length) {
			block_accessibilite_style.sheet.deleteRule(0);
		}
		if (block_accessibilite_num_cursor >3) 
		{
			block_accessibilite_num_cursor=0;
		}
		if (block_accessibilite_num_cursor!=0)
		{
			block_accessibilite_style.sheet.insertRule("body ,input[type=checkbox],input[type=text], input:hover{ cursor: url('/blocks/accessibilite/cursor/auto"+block_accessibilite_num_cursor+".png') 15 0,auto !important; }", 0);
			block_accessibilite_style.sheet.insertRule("a, button, button.btn, input[type=button], input[type=submit], input[type=reset],select { cursor: url('/blocks/accessibilite/cursor/hand"+block_accessibilite_num_cursor+".png') 20 0,auto !important; }", 1);
			block_accessibilite_style.sheet.insertRule("input[type=text],input[type=password],input[type=number],textarea { cursor: url('/blocks/accessibilite/cursor/type"+block_accessibilite_num_cursor+".png') 30 30,auto !important; }", 2);
			block_accessibilite_style.sheet.insertRule("button {color : red }", 1);
		}
		block_accessibilite_recap();
	}
	
	// mis à jour du champ texte et du cookie
	function block_accessibilite_recap() {
		var texte="";
		texte=block_accessibilite_background+':'+block_accessibilite_text+':'+block_accessibilite_taille+':'+block_accessibilite_interligne+':'+block_accessibilite_espaceCaractere+':'+block_accessibilite_espaceMot+':'+block_accessibilite_font+':'+block_accessibilite_bold+':'+block_accessibilite_italic+':'+block_accessibilite_couleur1+':'+block_accessibilite_couleur2+':'+block_accessibilite_altern+':'+block_accessibilite_mono+':'+block_accessibilite_num_cursor;
		document.getElementsByName('block_accessibilite_code')[0].value=texte;
		block_accessibilite_setCookie('accessibilite',texte,30);
	}
	
	// initialise les données par la lecture du cookie
	function block_accessibilite_init() {
			var elementcode=document.getElementById('accessibilite-code');
			config =elementcode.dataset.code
			if (config!='')
			{
				res=config.split(':');
				block_accessibilite_background=res[0];
				block_accessibilite_text=res[1];
				block_accessibilite_taille=parseFloat(res[2],10);
				block_accessibilite_interligne=parseFloat(res[3],10);
				block_accessibilite_espaceCaractere=parseFloat(res[4],10);
				block_accessibilite_espaceMot=parseFloat(res[5],10);
				block_accessibilite_police=res[6];
				block_accessibilite_bold=res[7];
				block_accessibilite_italic=res[8];
				block_accessibilite_couleur1=res[9];
				block_accessibilite_couleur2=res[10];
				block_accessibilite_altern=res[11];
				block_accessibilite_mono=res[12];
				block_accessibilite_num_cursor = res[13];

				block_accessibilite_setConfig();
				block_accessibilite_recap();
			}
			else
			{
				block_accessibilite_background='rgb(255,255,255)';
				block_accessibilite_text='rgb(0,0,0)';
				block_accessibilite_taille=1;
				block_accessibilite_interligne=1;
				block_accessibilite_espaceCaractere=0;
				block_accessibilite_espaceMot=.1;
				block_accessibilite_police='helvetica';
				block_accessibilite_bold=0;
				block_accessibilite_italic=0;
				block_accessibilite_altern=0;
				block_accessibilite_mono=0;
				block_accessibilite_num_cursor = 0;	
			}
//		}
	}
	
	function block_accessibilite_RAZ() {
		block_accessibilite_background='rgb(255,255,255)';
		block_accessibilite_text='rgb(0,0,0)';
		block_accessibilite_taille=1;
		block_accessibilite_interligne=1;
		block_accessibilite_espaceCaractere=0;
		block_accessibilite_espaceMot=.1;
		block_accessibilite_police='default';
		block_accessibilite_bold=0;
		block_accessibilite_italic=0;
		block_accessibilite_altern=0;
		block_accessibilite_mono=0;
		block_accessibilite_num_cursor = 0;
		block_accessibilite_setConfig();
		document.getElementsByName('block_accessibilite_code')[0].value='';
		block_accessibilite_setCookie('accessibilite','',0);
		location.reload();
	}
	
	function block_accessibilite_AppliquerValeur() {
		config=document.getElementsByName('block_accessibilite_code')[0].value;
		res=config.split(':');
		block_accessibilite_background=res[0];
		block_accessibilite_text=res[1];
		block_accessibilite_taille=parseFloat(res[2],10);
		block_accessibilite_interligne=parseFloat(res[3],10);
		block_accessibilite_espaceCaractere=parseFloat(res[4],10);
		block_accessibilite_espaceMot=parseFloat(res[5],10);
		block_accessibilite_police=res[6];
		block_accessibilite_bold=res[7];
		block_accessibilite_italic=res[8];
		block_accessibilite_couleur1=res[9];
		block_accessibilite_couleur2=res[10];
		block_accessibilite_altern=res[11];
		block_accessibilite_mono=res[12];
		block_accessibilite_num_cursor = res[13];
		block_accessibilite_setConfig();
		block_accessibilite_recap();
	}
	function block_accessibilite_setConfig() {
		block_accessibilite_setBackground(block_accessibilite_background);
		block_accessibilite_setTextColor(block_accessibilite_text);
		block_accessibilite_setTaille(block_accessibilite_taille);
		block_accessibilite_setInterligne(block_accessibilite_interligne);
		block_accessibilite_setEspaceCaractere(block_accessibilite_espaceCaractere);
		block_accessibilite_setEspaceMot(block_accessibilite_espaceMot);
		block_accessibilite_setPolice(block_accessibilite_police);
		if (block_accessibilite_altern == 1)
			block_accessibilite_alterncolor();
		if (block_accessibilite_mono == 1)
			block_accessibilite_monochrome();
		block_accessibilite_changeCursor(block_accessibilite_num_cursor);
	}
	
	block_accessibilite_init();
	
