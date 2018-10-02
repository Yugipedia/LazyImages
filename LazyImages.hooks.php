<?php

class LazyImages {

	public static function ThumbnailBeforeProduceHTML($thumb, &$attribs, &$linkAttribs) {
		global $wgRequest, $wgTitle;
		if (defined('MW_API') && $wgRequest->getVal('action') === 'parse') return true;
		if (isset($wgTitle) && $wgTitle->getNamespace() === NS_FILE) return true;
		
		$attribs['data-src'] = $attribs['src'];
		//$attribs['src'] = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';

		if (isset($attribs['data-src'])) {
			$attribs['src'] = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
		}

		$attribs['class'] = 'lazy';
		
		return true;
	}

	public static function BeforePageDisplay($out, $skin) {
		$out->addModules( 'ext.lazyload' );
		return true;
	}

}
