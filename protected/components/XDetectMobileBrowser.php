<?php
/**
 * XDetectMobileBrowser class file.
 *
 * @author Marco van 't Wout <marco@tremani.nl>
 * @copyright Copyright &copy; Tremani, 2011
 */

/**
 * Handles detecting mobile browsers.
 * Results are stored locally for caching calls within the same request, and
 * stored in a cookie for caching across requests.
 *
 * Install as an application component, in your config:
 *
 * 'components' => array(
 *    'detectMobileBrowser' => array(
 *        'class' => 'wabbit.extensions.yii-detectmobilebrowser.XDetectMobileBrowser',
 *     ),
 * ),
 *
 * You can use it like this:
 *
 * if (Yii::app()->detectMobileBrowser->showMobile) {
 *     // do something
 * }
 *
 */
class XDetectMobileBrowser extends CApplicationComponent
{
	/**
	 * Cookie name for storing result
	 */
	const COOKIE_NAME = 'kigMobile';

	/**
	 * @var boolean show mobile version to the client?
	 */
	protected $showMobile;

	/**
	 * Call isMobileBrowser, store result in $showMobile.
	 * Across requests, store result in cookie.
	 */
	public function getShowMobile()
	{
		if (!isset($this->showMobile)) {
			$cookie = Yii::app()->request->cookies[self::COOKIE_NAME];
			if (isset($cookie)) {
				$this->showMobile = (bool)$cookie->value;
			} else {
				$this->showMobile = $this->isMobileBrowser();
				$this->setCookie();
			}
		}
		return $this->showMobile;
	}

	/**
	 * Explicitly set value for isMobile. Store in cookie.
	 * @param bool $value
	 */
	public function setShowMobile($value)
	{
		unset(Yii::app()->request->cookies[self::COOKIE_NAME]);
		$this->showMobile = (bool)$value;
		$this->setCookie();
	}

	/**
	 * Set cookie for storing isMobile
	 */
	private function setCookie()
	{
		$cookie = new CHttpCookie(self::COOKIE_NAME, (int)$this->showMobile);
		$cookie->expire = time()+(3600*24*365); //1 year
		$cookie->path = Yii::app()->baseUrl;
		Yii::app()->request->cookies[self::COOKIE_NAME] = $cookie;
	}

	/**
	 * Performs a regexp check on the User Agent string to determine if this is a mobile browser.
	 * Last updated: 28-2-2012
	 * @see http://detectmobilebrowsers.com/
	 * @return bool is mobile
	 */
	public function isMobileBrowser()
	{
		$useragent=$_SERVER['HTTP_USER_AGENT'];
        $accept=$_SERVER['HTTP_ACCEPT'];
		return
			preg_match('/android.+mobile|nokia|samsung|smartphone|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket( pc)?|psp|symbian|treo|up\.(browser|link)|vodafone|wap(1\.|2\.)?|windows (ce|phone)|xda|xiino/i',$useragent) ||
			preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)) ||
			preg_match('/text\/vnd\.wap\.wml|application\/vnd\.wap\.xhtml\+xml/i', $accept);
	}
}