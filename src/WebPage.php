<?php declare(strict_types=1);

/**
 * Classe WebPage permettant de ne plus écrire l'enrobage HTML lors de la création d'une page Web.
 **/
class WebPage
{
    /**
     * Texte compris entre \<head\> et \</head\>.
     *
     * @var string $head
     */
    private $head = '';

    /**
     * Texte compris entre \<title\> et \</title\>.
     *
     * @var string $title
     */
    private $title = null;

    /**
     * Texte compris entre \<body\> et \</body\>.
     *
     * @var string $body
     */
    private $body = '';

    /**
     * Constructeur.
     *
     * @param string $title Titre de la page
     */
    public function __construct(string $title = null)
    {
        if (!is_null($title)) {
            $this->setTitle($title);
        }
    }

    /**
     * Retourner le contenu de $this->body.
     *
     * @return string
     */
    public function body(): string
    {
        return $this->body;
    }

    /**
     * Retourner le contenu de $this->head.
     *
     * @return string
     */
    public function head(): string
    {
        return $this->head;
    }

    /**
     * Affecter le titre de la page.
     *
     * @param string $title Le titre
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Ajouter un contenu dans $this->head.
     *
     * @param string $content Le contenu à ajouter
     */
    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    /**
     * Ajouter un contenu CSS dans head.
     *
     * @param string $css Le contenu CSS à ajouter
     *@see WebPage::appendToHead(string $content) : void
     *
     */
    public function appendCss(string $css): void
    {
        $this->appendToHead(<<<HTML
    <style type='text/css'>
    {$css}
    </style>

HTML
        );
    }

    /**
     * Ajouter l'URL d'un script CSS dans head.
     *
     * @param string $url L'URL du script CSS
     *@see WebPage::appendToHead(string $content) : void
     *
     */
    public function appendCssUrl(string $url): void
    {
        $this->appendToHead(<<<HTML
    <link rel="stylesheet" type="text/css" href="{$url}">

HTML
        );
    }

    /**
     * Ajouter un contenu JavaScript dans head.
     *
     * @param string $js Le contenu JavaScript à ajouter
     *@see WebPage::appendToHead(string $content) : void
     *
     */
    public function appendJs(string $js): void
    {
        $this->appendToHead(<<<HTML
    <script type='text/javascript'>
    {$js}
    </script>

HTML
        );
    }

    /**
     * Ajouter l'URL d'un script JavaScript dans head.
     *
     * @param string $url L'URL du script JavaScript
     *@see WebPage::appendToHead(string $content) : void
     *
     */
    public function appendJsUrl(string $url): void
    {
        $this->appendToHead(<<<HTML
    <script type='text/javascript' src='{$url}'></script>

HTML
        );
    }

    /**
     * Ajouter un contenu dans body.
     *
     * @param string $content Le contenu à ajouter
     */
    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    /**
     * Produire la page Web complète.
     *
     * @return string
     *
     * @throws Exception si title n'est pas défini
     */
    public function toHTML(): string
    {
        if (is_null($this->title)) {
            throw new Exception(__CLASS__.': title not set');
        }

        return <<<HTML
        <!doctype html>
        <html lang="fr">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" type="text/css" href="css/css.css">
                <title>{$this->title}</title>
                {$this->head()}
            </head>
            <body>
                {$this->getHeader()}
                {$this->body}
                {$this->getFooter()}
            </body>
        </html>
        HTML;
    }

    /**
     * Protéger les caractères spéciaux pouvant dégrader la page Web.
     *
     * @param string $string La chaîne à protéger
     *
     * @return string La chaîne protégée
     *
     * @see https://www.php.net/manual/en/function.htmlspecialchars.php
     */
    public static function escapeString(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'utf-8');
    }

    public function getHTMLButton(bool $submitType, string $value, string $href=''): string {
        return $submitType ? "<input class='button' type=\"submit\" value=\"$value\">" : "<a class='button' href=\"$href\">$value</a>";
    }

    public function getHTMLInput(string $title = '', string $inputType = '', string $name='', string $id='', string $placeholder='', string $value='', bool $required=true, bool $hidden=false): string {
        return "<div class='form-input'><label for='$id'>$title</label>
        <input type='$inputType' name='$name' id='$id' value='$value' placeholder='$placeholder' ".($required ? "required ": "").($hidden ? "hidden " : "")."></div>";
    }

    public function getSVGPers(): string {
        return "<svg class='pr-1' width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
        <path d='M12 3C9.59489 3 7.64516 4.93577 7.64516 7.32367C7.64516 9.71157 9.59489 11.6473 12 11.6473C14.4051 11.6473 16.3548 9.71157 16.3548 7.32367C16.3548 4.93577 14.4051 3 12 3Z' fill='#373737'/>
        <path d='M7.35484 13.9533C4.94973 13.9533 3 15.8891 3 18.277V19.647C3 20.5155 3.63393 21.256 4.49722 21.3959C9.46618 22.2014 14.5338 22.2014 19.5028 21.3959C20.3661 21.256 21 20.5155 21 19.647V18.277C21 15.8891 19.0503 13.9533 16.6452 13.9533H16.2493C16.0351 13.9533 15.8222 13.9869 15.6185 14.053L14.6134 14.3788C12.9152 14.9293 11.0848 14.9293 9.38662 14.3788L8.3815 14.053C8.17784 13.9869 7.96494 13.9533 7.75069 13.9533H7.35484Z' fill='#373737'/>
        </svg>";
    }

    public function getSVGMail():string {
        return "<svg class='pr-1' width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
        <path d='M5.33333 6C4.44928 6 3.60143 6.33714 2.97631 6.93726C2.35119 7.53737 2 8.35131 2 9.2V9.5216L12 14.6912L22 9.5232V9.2C22 8.35131 21.6488 7.53737 21.0237 6.93726C20.3986 6.33714 19.5507 6 18.6667 6H5.33333Z' fill='#373737'/>
        <path d='M22 11.3392L12.395 16.304C12.2736 16.3667 12.1379 16.3996 12 16.3996C11.8621 16.3996 11.7264 16.3667 11.605 16.304L2 11.3392V18.8C2 19.6487 2.35119 20.4626 2.97631 21.0627C3.60143 21.6628 4.44928 22 5.33333 22H18.6667C19.5507 22 20.3986 21.6628 21.0237 21.0627C21.6488 20.4626 22 19.6487 22 18.8V11.3392Z' fill='#373737'/>
        </svg>";
    }

    public function getSVGMdp():string {
        return "<svg class='pr-1' width='16' height='22' viewBox='0 0 16 22' fill='none' xmlns='http://www.w3.org/2000/svg'>
        <path fill-rule='evenodd' clip-rule='evenodd' d='M2.80757 6.31892L3.18707 9.87854L2.4191 9.94244C1.34816 10.0315 0.473688 10.8705 0.300085 11.9755C-0.100028 14.5221 -0.100028 17.1196 0.300085 19.6662C0.473688 20.7712 1.34816 21.6101 2.4191 21.6992L4.07416 21.8369C6.68723 22.0544 9.31277 22.0544 11.9258 21.8369L13.5809 21.6992C14.6518 21.6101 15.5263 20.7712 15.6999 19.6662C16.1 17.1196 16.1 14.5221 15.6999 11.9755C15.5263 10.8705 14.6518 10.0315 13.5809 9.94244L12.8128 9.87853L13.1923 6.31892C13.2371 5.89929 13.2371 5.47579 13.1923 5.05616L13.1671 4.81994C12.9 2.31426 11.0099 0.331681 8.6074 0.0371121C8.20382 -0.0123707 7.79607 -0.0123707 7.39249 0.037112C4.99 0.33168 3.09989 2.31426 2.83275 4.81994L2.80757 5.05616C2.76283 5.47579 2.76283 5.89929 2.80757 6.31892ZM8.41352 1.7546C8.13875 1.72091 7.86114 1.72091 7.58637 1.7546C5.95067 1.95516 4.66382 3.30496 4.48194 5.01091L4.45676 5.24714C4.42555 5.53984 4.42555 5.83524 4.45676 6.12794L4.84261 9.74709C6.94534 9.60655 9.05455 9.60654 11.1573 9.74708L11.5431 6.12794C11.5743 5.83524 11.5743 5.53984 11.5431 5.24714L11.5179 5.01091C11.3361 3.30496 10.0492 1.95516 8.41352 1.7546ZM7.99997 14.0915C7.08354 14.0915 6.34063 14.8658 6.34063 15.8208C6.34063 16.7759 7.08354 17.5502 7.99997 17.5502C8.9164 17.5502 9.65931 16.7759 9.65931 15.8208C9.65931 14.8658 8.9164 14.0915 7.99997 14.0915Z' fill='#373737'/>
        </svg>";
    }

    public function getSVGTel(): string {
        return "<svg class='pr-1' width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
        <path d='M15.75 2C16.3467 2 16.919 2.23705 17.341 2.65901C17.7629 3.08097 18 3.65326 18 4.25V19.75C18 20.3467 17.7629 20.919 17.341 21.341C16.919 21.7629 16.3467 22 15.75 22H8.25C7.65326 22 7.08097 21.7629 6.65901 21.341C6.23705 20.919 6 20.3467 6 19.75V4.25C6 3.65326 6.23705 3.08097 6.65901 2.65901C7.08097 2.23705 7.65326 2 8.25 2H15.75ZM14.75 4.5H9.25C9.05998 4.50006 8.87706 4.57224 8.73821 4.70197C8.59936 4.8317 8.51493 5.0093 8.50197 5.19888C8.48902 5.38846 8.54852 5.57589 8.66843 5.7233C8.78835 5.87071 8.95975 5.9671 9.148 5.993L9.25 6H14.75C14.94 5.99994 15.1229 5.92776 15.2618 5.79803C15.4006 5.6683 15.4851 5.4907 15.498 5.30112C15.511 5.11154 15.4515 4.92411 15.3316 4.7767C15.2117 4.62929 15.0402 4.5329 14.852 4.507L14.75 4.5Z' fill='#373737'/>
        </svg>";
    }

    private function getHeader() : string {
        return <<<HTML
            <div class="header">
                <a class="link" href="">ACCUEIL</a>
            </div>
        HTML;
    }

    private function getFooter() : string {
        return <<<HTML
            <div class="footer"></div>
        HTML;
    }
}
