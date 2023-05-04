<?php declare(strict_types = 1);

namespace App\Lib\MessageCollector;

use App\Entity\Message;

class MVFCollector implements MessageCollectorInterface
{
    public function getMessages(): array
    {
        $warnings = $this->getWarnings();
        $messageParts = [];

        foreach ($warnings as $warning) {
            if (isset($warning['severity']) && $warning['severity'] !== 'information') {
                $messageParts[] = $warning['key'] . ': ' . str_replace('"', '', $warning['message']);
            }
        }

        return $messageParts? [new Message('MVF', implode("\n", $messageParts))] : [];
    }

    private function getWarnings(): array
    {
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, 'https://mvf.web-prod-1.rancher-prod-1.medi-verbund.de/api/auftrag/warnings');
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curlSession);

        $warnings = json_decode($result, true) ;
        if (isset($warnings['code'])) {
            return [];
        }

        return $warnings;
    }
}
