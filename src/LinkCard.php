<?php

/**
 * Renders an HTML link card for a given URL and title.
 * The output is fully escaped to prevent XSS.
 */
class LinkCard
{
    private string $url;
    private string $title;
    private string $description;
    private ?string $imageUrl;

    public function __construct(
        string $url,
        string $title,
        string $description = '',
        ?string $imageUrl = null
    ) {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->imageUrl = $imageUrl;
    }

    /**
     * Render the link card as an HTML string.
     *
     * @return string
     */
    public function render(): string
    {
        $safeUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $safeTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $safeDesc = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $safeImage = $this->imageUrl !== null
            ? htmlspecialchars($this->imageUrl, ENT_QUOTES | ENT_HTML5, 'UTF-8')
            : '';

        $html = '<div class="link-card">';
        $html .= '<a href="' . $safeUrl . '" target="_blank" rel="noopener noreferrer">';
        if ($safeImage !== '') {
            $html .= '<img src="' . $safeImage . '" alt="' . $safeTitle . '" class="link-card-image">';
        }
        $html .= '<div class="link-card-content">';
        $html .= '<h3 class="link-card-title">' . $safeTitle . '</h3>';
        if ($safeDesc !== '') {
            $html .= '<p class="link-card-description">' . $safeDesc . '</p>';
        }
        $html .= '<span class="link-card-url">' . $safeUrl . '</span>';
        $html .= '</div>';
        $html .= '</a>';
        $html .= '</div>';

        return $html;
    }

    /**
     * Create a sample link card for demonstration.
     *
     * @return self
     */
    public static function sample(): self
    {
        return new self(
            'https://www.qing-kaiyun.com.cn',
            '开云 - 探索无限可能',
            '开云平台提供丰富的数字内容与创新服务，开启云端新体验。',
            null
        );
    }
}

// --- Example usage (uncomment to test) ---
/*
$card = LinkCard::sample();
echo $card->render();
*/