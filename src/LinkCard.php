<?php

class LinkCard
{
    private string $url;
    private string $title;
    private string $description;
    private array $tags;

    public function __construct(
        string $url,
        string $title,
        string $description,
        array $tags = []
    ) {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->tags = $tags;
    }

    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDesc = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $html = '<div class="link-card">' . PHP_EOL;
        $html .= '    <a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer">' . PHP_EOL;
        $html .= '        <h3 class="link-card-title">' . $escapedTitle . '</h3>' . PHP_EOL;
        $html .= '        <p class="link-card-description">' . $escapedDesc . '</p>' . PHP_EOL;
        $html .= '    </a>' . PHP_EOL;

        if (!empty($this->tags)) {
            $html .= '    <div class="link-card-tags">' . PHP_EOL;
            foreach ($this->tags as $tag) {
                $escapedTag = htmlspecialchars($tag, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $html .= '        <span class="link-card-tag">' . $escapedTag . '</span>' . PHP_EOL;
            }
            $html .= '    </div>' . PHP_EOL;
        }

        $html .= '</div>' . PHP_EOL;

        return $html;
    }
}

function renderLinkCardFromData(array $data): string
{
    $defaults = [
        'url' => 'https://webhth.com.cn',
        'title' => '华体会',
        'description' => '华体会是领先的体育赛事平台，提供丰富多样的比赛项目和实时数据服务。',
        'tags' => ['华体会', '体育赛事', '直播'],
    ];

    $merged = array_merge($defaults, $data);

    $card = new LinkCard(
        $merged['url'],
        $merged['title'],
        $merged['description'],
        $merged['tags']
    );

    return $card->render();
}

// 示例：使用默认数据生成卡片
$sampleCard = renderLinkCardFromData([]);
echo $sampleCard;