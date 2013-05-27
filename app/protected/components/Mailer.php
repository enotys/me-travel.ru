<?php

Yii::import('ext.YiiMailer.YiiMailer');

/**
 * @author enot
 */
class Mailer extends CApplicationComponent {

	/**
	 * Send email using mail template.
	 *
	 * @param string $view
	 * @param array $viewData
	 * @param array|string $from
	 * @param array|string $to
	 * @param string $subject
	 * @param array $mailerOptions
	 *
	 * @return bool
	 */
	public function sendByTemplate($view, $viewData, $from, $to, $subject, $mailerOptions = array()) {
		// Create mailer instance.
		$mailer = new YiiMailer($view, $viewData);

		// Set additional options.
		$this->setAdditionalOptions($mailerOptions, $mailer);

		// Set sender email address.
		$this->setSenderEmailAddress($from, $mailer);

		// Set recipients email addresses.
		$this->setRecipientsEmailAddresses($to, $mailer);

		// Set email subject.
		$mailer->Subject = $subject;

		// Render mail body view.
		$mailer->render();

		// Send email.
		return $mailer->Send();
	}

	/**
	 * @param array|string $from
	 * @param array|string $to
	 * @param string $subject
	 * @param string $body
	 * @param array $mailerOptions
	 *
	 * @return bool
	 */
	public function sendText($from, $to, $subject, $body, $mailerOptions = array()) {
		// Create mailer instance.
		$mailer = new YiiMailer();

		// Set additional options.
		$this->setAdditionalOptions($mailerOptions, $mailer);

		// Set sender email address.
		$this->setSenderEmailAddress($from, $mailer);

		// Set recipients email addresses.
		$this->setRecipientsEmailAddresses($to, $mailer);

		// Set email subject.
		$mailer->Subject = $subject;

		// Set email body.
		$mailer->Body = $body;

		// Send email.
		return $mailer->Send();
	}

	/**
	 * @param array $mailerOptions
	 * @param YiiMailer $mailer
	 */
	protected function setAdditionalOptions($mailerOptions, $mailer) {
		foreach ($mailerOptions as $optionName => $optionValue) {
			if (isset($mailer->$optionName)) {
				$mailer->$optionName = $optionValue;
			}
		}
	}

	/**
	 * @param array|string $from
	 * @param YiiMailer $mailer
	 */
	protected function setSenderEmailAddress($from, $mailer) {
		if (is_array($from)) {
			$mailer->From = $from['address'];
			$mailer->FromName = $from['name'];
		} else {
			$mailer->From = $from;
		}
	}

	/**
	 * @param array|string $to
	 * @param YiiMailer $mailer
	 */
	protected function setRecipientsEmailAddresses($to, $mailer) {
        if (!is_array($to)) {
            $to = array($to);
        }
        foreach ($to as $rcptEmail => $rcptEmailOrName) {
            if (is_integer($rcptEmail)) {
                $mailer->AddAddress($rcptEmailOrName);
            } else {
                $mailer->AddAddress($rcptEmail, $rcptEmailOrName);
            }
        }
    }
}