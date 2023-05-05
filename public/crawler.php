<?php
	/**
	 * getProduits
	 * @param int $nombre
	 * @param int $debut
	 */

	function getProduits($nombre = 24, $page = 1) {

		$s = curl_init();
		$url = "https://www.saq.com/fr/produits/vin?p=".$page."&product_list_limit=".$nombre."&product_list_order=name_asc";
		//curl_setopt($s, CURLOPT_URL, "http://www.saq.com/webapp/wcs/stores/servlet/SearchDisplay?searchType=&orderBy=&categoryIdentifier=06&showOnly=product&langId=-2&beginIndex=".$debut."&tri=&metaData=YWRpX2YxOjA8TVRAU1A%2BYWRpX2Y5OjE%3D&pageSize=". $nombre ."&catalogId=50000&searchTerm=*&sensTri=&pageView=&facet=&categoryId=39919&storeId=20002");
		//curl_setopt($s, CURLOPT_URL, "https://www.saq.com/webapp/wcs/stores/servlet/SearchDisplay?categoryIdentifier=06&showOnly=product&langId=-2&beginIndex=" . $debut . "&pageSize=" . $nombre . "&catalogId=50000&searchTerm=*&categoryId=39919&storeId=20002");
		//curl_setopt($s, CURLOPT_URL, $url);
		//curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($s, CURLOPT_CUSTOMREQUEST, 'GET');
        //curl_setopt($s, CURLOPT_NOBODY, false);
		//curl_setopt($s, CURLOPT_FOLLOWLOCATION, 1);

        // Se prendre pour un navigateur pour berner le serveur de la saq...
        curl_setopt_array($s,array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT=>'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0',
            CURLOPT_ENCODING=>'gzip, deflate',
            CURLOPT_HTTPHEADER=>array(
                    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                    'Accept-Language: en-US,en;q=0.5',
                    'Accept-Encoding: gzip, deflate',
                    'Connection: keep-alive',
                    'Upgrade-Insecure-Requests: 1',
            ),
    ));

		$_webpage = curl_exec($s);
		$_status = curl_getinfo($s, CURLINFO_HTTP_CODE);
		curl_close($s);

		$doc = new DOMDocument();
		$doc -> recover = true;
		$doc -> strictErrorChecking = false;
		@$doc -> loadHTML($_webpage);
		$elements = $doc -> getElementsByTagName("li");
		foreach ($elements as $key => $noeud) {
			if (strpos($noeud -> getAttribute('class'), "product-item") !== false) {
				$info = recupereInfo($noeud);
				return $info;
			}
		}
	}

	function get_inner_html($node) {
		$innerHTML = '';
		$children = $node -> childNodes;
		foreach ($children as $child) {
			$innerHTML .= $child -> ownerDocument -> saveXML($child);
		}
		return $innerHTML;
	}

	function nettoyerEspace($chaine){
		return preg_replace('/\s+/', ' ',$chaine);
	}

	function recupereInfo($noeud) {
		$info = new stdClass();
		$img = $noeud -> getElementsByTagName("img") -> item(0) -> getAttribute('src');
		if(strpos($img, 'https://www.saq.com/media/wysiwyg') === false) {
			$info -> img = $noeud -> getElementsByTagName("img") -> item(0) -> getAttribute('src');
		} else {
			$info -> img = $noeud -> getElementsByTagName("img") -> item(1) -> getAttribute('src');
		}
		$info->img = strstr($info->img, "?", true);
		$a_titre = $noeud -> getElementsByTagName("a") -> item(0);
		$info -> url = $a_titre->getAttribute('href');
        $nom = $noeud -> getElementsByTagName("a")->item(1)->textContent;
		$info -> nom = nettoyerEspace(trim($nom));
		// Type, format et pays
		$aElements = $noeud -> getElementsByTagName("strong");
		foreach ($aElements as $node) {
			if ($node->getAttribute('class') == 'product product-item-identity-format') {
				$info->desc = new stdClass();
				$info->desc->texte = $node->textContent;
				$info->desc->texte = nettoyerEspace($info->desc->texte);
				$aDesc = explode("|", $info->desc->texte); // Type, Format, Pays
				if (count($aDesc) == 3) {
					$info->type = trim($aDesc[0]);
					$info->format = trim($aDesc[1]);
					$info->pays = trim($aDesc[2]);
				}
				$info->desc->texte = trim($info->desc->texte);
				unset($info->desc->texte);
			}
		}


		//Code SAQ
		$aElements = $noeud -> getElementsByTagName("div");
		foreach ($aElements as $node) {
			if ($node -> getAttribute('class') == 'saq-code') {
				if(preg_match("/\d+/", $node -> textContent, $aRes)){
					$info -> code_SAQ = trim($aRes[0]);
				}
			}
		}

		$aElements = $noeud -> getElementsByTagName("span");
		foreach ($aElements as $node) {
			if ($node -> getAttribute('class') == 'price') {
				$info -> prix = floatval(str_replace( "," , ".",$node -> textContent,));
			}
		}

		$arr = json_decode(json_encode($info), true);
		$result = array();
		foreach ($arr as $key => $value) {
			if (!empty($value)) {
				$result[$key] = $value;
			}
		}
		$return_arr = array(
			'url' => $result['url'],
			'nom' => $result['nom'],
			'type' => $result['type'],
			'format' => $result['format'],
			'pays' => $result['pays'],
			'code_saq' => $result['code_SAQ'],
			'prix' => $result['prix'],
			'img' => $result["img"]?? '/img/placehloder_bottle.webp'
		);
		return $return_arr;

	}
