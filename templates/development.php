<?php

use Yiisoft\FriendlyException\FriendlyExceptionInterface;

/**
 * @var $this \Yiisoft\ErrorHandler\Renderer\HtmlRenderer
 * @var $request \Psr\Http\Message\ServerRequestInterface|null
 * @var $throwable \Throwable
 */

$theme = $_COOKIE['yii-exception-theme'] ?? '';

$isFriendlyException = $throwable instanceof FriendlyExceptionInterface;
$solution = $isFriendlyException ? $throwable->getSolution() : null;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->htmlEncode($this->getThrowableName($throwable)) ?>
    </title>
    <style>
        /* reset */
        html,
        body,
        div,
        span,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        pre,
        a,
        code,
        em,
        img,
        strong,
        b,
        i,
        ul,
        li {
            margin: 0;
            padding: 0;
            border: 0;
            font: inherit;
            vertical-align: baseline;
        }

        body {
            font-family: 'Roboto', sans-serif;
            min-width: 800px;
            color: #505050;
            line-height: 1;
        }

        ul {
            list-style: none;
        }
        /* end reset */

        /* base */
        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
        /* end base */

        /* header */
        header {
            padding: 65px 100px 270px 100px;
            background: #ededed;
        }

        header .tools {
            margin-bottom: 50px;
            text-align: right;
        }

        header .tools a {
            margin-left: 45px;
            text-decoration: none;
        }

        header .tools a:hover svg path {
            fill: #000;
        }

        header .exception-card {
            position: relative;
            background: #fafafa;
            border: 2px solid #3F87D2;
            box-sizing: border-box;
            padding: 40px 30px;
            word-break: break-word;
        }

        header .exception-class {
            padding-right: 114px;
            margin-bottom: 30px;
            font-weight: 500;
            font-size: 26px;
            color: #3F87D2;
        }

        header .exception-class a {
            color: #3F87D2;
        }

        header .exception-message {
            font-size: 18px;
            color: #4b4b4b;
        }

        header .exception-class span,
        header .exception-class span a {
            color: #3F87D2;
        }

        header .solution {
            margin-top: 24px;
            font-size: 16px;
            line-height: 22px;
        }

        header .solution h1 {
            margin-top: 24px;
            font-size: 26px;
            line-height: 32px;
            font-weight: bold;
        }

        header .solution h2 {
            margin-top: 24px;
            font-size: 22px;
            line-height: 28px;
            font-weight: bold;
        }

        header .solution h3 {
            margin-top: 24px;
            font-size: 20px;
            line-height: 26px;
            font-weight: bold;
        }

        header .solution h4 {
            margin-top: 24px;
            font-size: 18px;
            line-height: 24px;
            font-weight: bold;
        }

        header .solution h5 {
            margin-top: 24px;
            font-size: 16px;
            line-height: 22px;
            font-weight: bold;
        }

        header .solution h6 {
            margin-top: 24px;
            font-size: 14px;
            line-height: 20px;
            font-weight: bold;
        }

        header .solution p {
            margin-top: 16px;
        }

        header .solution a {
            color: #00617b;
            text-decoration: underline;
        }
        header .solution a:hover {
            color: #1191b3;
        }
        .dark-theme header .solution a {
            color: #03a9f4;
        }
        .dark-theme header .solution a:hover {
            color: #39b9f3;
        }

        header .solution h1:first-child,
        header .solution h2:first-child,
        header .solution h3:first-child,
        header .solution h4:first-child,
        header .solution h5:first-child,
        header .solution h6:first-child,
        header .solution p:first-child {
            margin-top: 0;
        }

        header .solution blockquote {
            margin: 18px 0 18px 4px;
            padding: 3px 0 2px 16px;
            border-left: 4px solid #e4e4e4;
            color: #707070;
        }
        .dark-theme header .solution blockquote {
            color: #999;
            border-color: #484c50;
        }

        header .solution ul,
        header .solution ol {
            padding: 0;
            margin: 16px 0 0 32px;
        }
        header .solution li ul,
        header .solution li ol {
            margin: 0 0 0 24px;
        }

        header .solution li {
            margin: 8px 0 0 0;
        }

        header .solution ul {
            list-style: outside;
        }

        header .solution pre,
        header .solution code {
            font-family: monospace;
        }

        header .solution code {
            padding: 2px 6px;
            font-size: 90%;
            background-color: #f3f3f3;
            border-radius: 6px;
        }

        header .solution pre {
            margin: 24px 0;
            width: 100%;
            box-sizing: border-box;
            overflow: auto;
            padding: 14px;
            border-radius: 8px;
            background: #f3f3f3;
        }
        header .solution pre code {
            font-size: 100%;
            padding: 0;
            width: max-content;
        }

        .dark-theme header .solution code,
        .dark-theme header .solution pre {
            background: #2d333b;
        }

        header .solution table {
            margin: 16px 0 0 0;
            border-collapse: collapse;
        }
        header .solution td,
        header .solution th {
            padding: 6px 12px;
            border: 1px solid #e4e4e4;
        }
        .dark-theme header .solution td,
        .dark-theme header .solution th {
            border-color: #484c50;
        }

        header .solution HR {
            margin: 24px 0;
            border: 1px solid #ddd;
            border-width: 1px 0 0 0;
        }
        .dark-theme header .solution HR {
            border-color: #484c50;
        }

        header .previous {
            display: flex;
            margin-top: 20px;
        }

        header .previous .arrow {
            display: inline-block;
            transform: scale(-1, 1);
            font-size: 26px;
            color: #e51717;
            margin-top: -5px;
            margin-right: 10px;
        }

        header .previous h2 {
            font-size: 20px;
            color: #e57373;
            margin-bottom: 10px;
        }

        header .previous h2 span {
            color: #e51717;
        }

        header .previous h3 {
            font-size: 14px;
            margin: 10px 0;
        }

        #clipboard {
            position: absolute;
            top: -500px;
            right: 300px;
            width: 750px;
            height: 150px;
        }

        #copy-stacktrace {
            position: absolute;
            right: 40px;
            top: 44px;
        }

        #copy-stacktrace:hover svg path {
            fill: #000;
        }

        #copied {
            display: none;
            position: absolute;
            right: 76px;
            top: 51px;
        }

        #light-mode {
            display: none;
        }
        /* end header */

        main {
            margin-left: 100px;
            margin-right: 100px;
        }

        @media screen and (max-width: 1200px) {
            header {
                padding-left: 50px;
                padding-right: 50px;
            }

            main {
                margin-left: 50px;
                margin-right: 50px;
            }
        }

        .flex-1 {
            flex: 1;
        }

        /* call stack */
        .call-stack ul li,
        .request {
            border: 2px solid #d0d0d0;
            box-shadow: 0 15px 20px rgba(0, 0, 0, 0.05);
            background: #fff;
            margin-bottom: 30px;
            border-radius: 3px;
        }

        .call-stack > ul > li:first-child {
            margin-top: -200px;
        }

        .call-stack > ul > li:last-child {
            margin-bottom: 50px;
        }

        .call-stack > ul > li.call-stack-vendor-group {
            background: #ededed;
        }

        .call-stack > ul > li.call-stack-vendor-group .call-stack-vendor-state {
            display: inline-block;
            height: 22px;
            width: 22px;
            font-size: 20px;
            color: #fff;
            background: #999;
            border-radius: 3px;
            text-align: center;
            margin-right: 15px;
        }

        .call-stack > ul > li.call-stack-vendor-group > ul {
            display: none;
            background: #ededed;
        }

        .call-stack > ul > li.call-stack-vendor-group > ul > li {
            border-left: 0;
            border-right: 0;
            box-shadow: none;
        }

        .call-stack > ul > li.call-stack-vendor-group > ul > li:last-child {
            border-bottom: 2px solid transparent;
            margin-bottom: 0;
        }

        .call-stack ul li .element-wrap {
            display: flex;
            cursor: pointer;
            padding: 20px 30px;
            font-weight: 500;
            font-size: 18px;
            line-height: 21px;
            color: #4b4b4b;
        }

        .call-stack ul li .element-wrap .file-name {
            color: #4b4b4b;
        }

        .call-stack ul li .element-wrap:hover .file-name,
        .call-stack ul li .element-code-wrap .code-wrap .lines-item:hover {
            color: #086eb6;
        }

        .call-stack ul li .element-wrap .function-info {
            display: inline-block;
        }

        .call-stack ul li.application .element-wrap {
            border-bottom: 1px solid #d0d0d0;
        }

        .call-stack ul li a {
            color: #505050;
        }

        .call-stack ul li a:hover {
            color: #000;
        }

        .call-stack ul li a .external-link {
            vertical-align: middle;
        }

        .call-stack ul li a .external-link:hover path {
            fill: #000;
        }

        .call-stack ul li a .external-link path {
            fill: #505050;
        }

        .call-stack ul li .element-code-wrap {
            overflow-x: auto;
        }

        .call-stack ul li .element-code-wrap .code-wrap {
            display: none;
            position: relative;
        }

        .call-stack ul li.application .element-code-wrap .code-wrap {
            display: block;
        }

        .call-stack ul li .error-line,
        .call-stack ul li .hover-line {
            background-color: #ffebeb;
            position: absolute;
            width: 100%;
            z-index: 100;
            margin-top: 0;
        }

        .call-stack ul li .hover-line {
            background: none;
        }

        .call-stack ul li .hover-line.hover,
        .call-stack ul li .hover-line:hover {
            background: #edf9ff !important;
        }

        .call-stack ul li .code {
            min-width: 700px;
            /* 800px - 50px * 2 */
            margin: 15px auto;
            padding: 0 50px;
            position: relative;
        }

        .call-stack ul li .code .lines-item {
            position: absolute;
            z-index: 200;
            display: block;
            width: 25px;
            text-align: right;
            color: #aaa;
            line-height: 20px;
            font-size: 12px;
            margin-top: 1px;
            font-family: JetBrains Mono, Consolas, monospace;
        }

        .call-stack ul li .code pre {
            position: relative;
            z-index: 200;
            left: 50px;
            line-height: 20px;
            font-size: 12px;
            font-family: JetBrains Mono, Consolas, monospace;
            display: inline;
        }

        @-moz-document url-prefix() {
            .call-stack ul li .code pre {
                line-height: 20px;
            }
        }
        /* end call stack */

        /* request */
        .request {
            padding: 20px 30px;
            font-size: 14px;
            line-height: 18px;
            overflow-x: auto;
            font-family: JetBrains Mono, Consolas, monospace;
        }
        /* end request */

        /* footer */
        .footer {
            display: flex;
        }

        .footer div {
            align-self: center;
        }

        .footer .timestamp,
        .footer .server {
            margin-bottom: 20px;
        }

        .footer p,
        .footer p a {
            font-size: 16px;
            line-height: 28px;
            color: #9c9c9c;
        }

        .footer p a:hover {
            color: #000;
        }

        .footer svg {}
        /* end footer */

        /* highlight.js */
        .hljs {
            display: block;
            color: #2f3337;
        }

        .hljs-comment {
            color: #656e77;
        }

        .hljs-keyword,
        .hljs-selector-tag,
        .hljs-meta-keyword,
        .hljs-doctag,
        .hljs-section,
        .hljs-selector-class,
        .hljs-meta,
        .hljs-selector-pseudo,
        .hljs-attr {
            color: #015692;
        }

        .hljs-attribute {
            color: #803378;
        }

        .hljs-name,
        .hljs-type,
        .hljs-number,
        .hljs-selector-id,
        .hljs-quote,
        .hljs-template-tag,
        .hljs-built_in,
        .hljs-title,
        .hljs-literal {
            color: #b75501;
        }

        .hljs-string,
        .hljs-regexp,
        .hljs-symbol,
        .hljs-variable,
        .hljs-template-variable,
        .hljs-link,
        .hljs-selector-attr,
        .hljs-meta-string {
            color: #54790d;
        }

        .hljs-bullet,
        .hljs-code {
            color: #535a60;
        }

        .hljs-deletion {
            color: #c02d2e;
        }

        .hljs-addition {
            color: #2f6f44;
        }

        .hljs-emphasis {
            font-style: italic;
        }

        .hljs-strong {
            font-weight: bold;
        }
        /* end highlight.js */

        /* start dark-theme */
        .dark-theme {
            background: rgba(46,46,46, 0.9);
            color: #fff;
        }

        .dark-theme header {
            background: #2e2e2e;
        }

        .dark-theme .exception-card {
            background: #222;
            border: 3px solid #591e15;
        }

        .dark-theme .exception-class,
        .dark-theme .call-stack ul li a {
            color: rgba(255, 255, 255, 0.5);
        }

        .dark-theme .exception-class span,
        .dark-theme .exception-class span a,
        .dark-theme .previous .arrow,
        .dark-theme .previous h2 span {
            color: #fff;
        }

        .dark-theme .exception-message,
        .dark-theme .solution,
        .dark-theme .previous {
            color: rgba(255, 255, 255, 0.8);
        }

        .dark-theme .call-stack ul li,
        .dark-theme .request {
            background: #1e1e1e;
            border: 2px solid transparent;
            box-shadow: 0 13px 20px rgba(0, 0, 0, 0.25);
        }

        .dark-theme .call-stack ul li.call-stack-vendor-group {
            background: rgba(46,46,46, 0.9);
            border: 2px solid #666;
        }

        .dark-theme .call-stack > ul > li.call-stack-vendor-group .call-stack-vendor-state {
            background: #666;
        }

        .dark-theme .call-stack > ul > li.call-stack-vendor-group > ul {
            background: rgba(46,46,46, 0.9);
        }

        .dark-theme .call-stack > ul > li.call-stack-vendor-group > ul > li {
            border-top: 2px solid #666;
            border-bottom: 2px solid #666;
            border-left: 0;
            border-right: 0;
            box-shadow: none;
        }

        .dark-theme .call-stack > ul > li.call-stack-vendor-group > ul > li:last-child {
            border-bottom: 2px solid transparent;
        }

        .dark-theme .call-stack ul li .error-line {
            background-color: #422c2c;
        }

        .dark-theme .call-stack ul li .hover-line.hover,
        .dark-theme .call-stack ul li .hover-line:hover {
            background: #292929 !important;
        }

        .dark-theme li.application .element-wrap {
            border-bottom: 1px solid #141414 !important;
        }

        .dark-theme .element-wrap,
        .dark-theme .element-wrap .file-name {
            color: #fff !important;
        }

        .dark-theme .element-wrap:hover .file-name,
        .dark-theme .call-stack ul li .element-code-wrap .code-wrap .lines-item:hover {
            color: #9cdcfe !important;
        }

        .dark-theme header .tools a:hover svg path,
        .dark-theme #copy-stacktrace:hover svg path,
        .dark-theme .call-stack ul li a .external-link:hover path {
            fill: #fff;
        }

        .dark-theme #copy-stacktrace svg path,
        .dark-theme header .tools a svg path,
        .dark-theme .call-stack ul li a .external-link path {
            fill: #989898;
        }

        .dark-theme #dark-mode {
            display: none;
        }

        .dark-theme #light-mode {
            display: inline;
        }

        .dark-theme .hljs {
            color: #fff;
        }

        .dark-theme .hljs-comment {
            color: #999;
        }

        .dark-theme .hljs-keyword,
        .dark-theme .hljs-selector-tag,
        .dark-theme .hljs-meta-keyword,
        .dark-theme .hljs-doctag,
        .dark-theme .hljs-section,
        .dark-theme .hljs-selector-class,
        .dark-theme .hljs-meta,
        .dark-theme .hljs-selector-pseudo,
        .dark-theme .hljs-attr {
            color: #88aece;
        }

        .dark-theme .hljs-attribute {
            color: #c59bc1;
        }

        .dark-theme .hljs-name,
        .dark-theme .hljs-type,
        .dark-theme .hljs-number,
        .dark-theme .hljs-selector-id,
        .dark-theme .hljs-quote,
        .dark-theme .hljs-template-tag,
        .dark-theme .hljs-built_in,
        .dark-theme .hljs-title,
        .dark-theme .hljs-literal {
            color: #f08d49;
        }

        .dark-theme .hljs-string,
        .dark-theme .hljs-regexp,
        .dark-theme .hljs-symbol,
        .dark-theme .hljs-variable,
        .dark-theme .hljs-template-variable,
        .dark-theme .hljs-link,
        .dark-theme .hljs-selector-attr,
        .dark-theme .hljs-meta-string {
            color: #b5bd68;
        }

        .dark-theme .hljs-bullet,
        .dark-theme .hljs-code {
            color: #cccccc;
        }

        .dark-theme .hljs-deletion {
            color: #de7176;
        }

        .dark-theme .hljs-addition {
            color: #76c490;
        }
        /* end dark-theme */
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700">
</head>
<body<?= !empty($theme) ? " class=\"{$this->htmlEncode($theme)}\"" : '' ?>>
<header>
    <div class="tools">
        <a href="#" title="Dark Mode" id="dark-mode">
            <svg width="28" height="28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M27.0597 19.06c-2.5312.9821-5.2934 1.2069-7.9501.6472-2.6568-.5598-5.0934-1.8799-7.0133-3.7998-1.9198-1.9198-3.24001-4.3565-3.79975-7.01324-.55974-2.65674-.33489-5.41892.64718-7.95016-3.04045 1.1849-5.57175 3.39424-7.15685 6.24657C.201778 10.0429-.337628 13.3592.26179 16.5668c.599419 3.2077 2.30004 6.1053 4.80824 8.1928C7.57822 26.847 10.7366 27.9931 13.9997 28c2.8246.0007 5.5833-.8527 7.9141-2.4481 2.3307-1.5955 4.1245-3.8585 5.1459-6.4919z" fill="#787878"/>
            </svg>
        </a>

        <a href="#" title="Light Mode" id="light-mode">
            <svg width="32" height="32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 2h2v5h-2V2zM21.6875 8.9l3.506-3.50699 1.414 1.415-3.506 3.50599-1.414-1.414zM25 15h5v2h-5v-2zM21.6875 23.1l1.414-1.414 3.506 3.506-1.414 1.415-3.506-3.507zM15 25h2v5h-2v-5zM5.39453 25.192l3.506-3.506 1.41397 1.415-3.50597 3.506-1.414-1.415zM2 15h5v2H2v-2zM5.39453 6.80801l1.414-1.415L10.3145 8.9l-1.41397 1.414-3.506-3.50599zM16 10c-1.1867 0-2.3467.3519-3.3334 1.0112-.9867.6593-1.7557 1.5963-2.2099 2.6927-.4541 1.0964-.57292 2.3028-.3414 3.4666.2315 1.1639.8029 2.233 1.6421 3.0721.8391.8392 1.9082 1.4106 3.0721 1.6421 1.1638.2315 2.3702.1127 3.4666-.3414 1.0964-.4541 2.0334-1.2232 2.6927-2.2099C21.6481 18.3467 22 17.1867 22 16c0-1.5913-.6321-3.1174-1.7574-4.2426C19.1174 10.6321 17.5913 10 16 10z" fill="#989898"/>
            </svg>
        </a>

        <a href="https://stackoverflow.com/search?<?= http_build_query(['q' => $throwable->getMessage()]) ?>" title="Search error on Stackoverflow" target="_blank">
            <svg width="28" height="32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.312 29.151v-8.536h2.849V32H.458008V20.615H3.29701v8.536H23.312zM6.14501 26.307H20.469v-2.848H6.14501v2.848zm.35-6.468L20.47 22.755l.599-2.76-13.96899-2.912-.605 2.756zm1.812-6.74L21.246 19.136l1.203-2.6-12.93699-6.041-1.204 2.584-.001.02zm3.61999-6.38L22.88 15.86l1.813-2.163L13.74 4.562l-1.803 2.151-.01.006zM19 0l-2.328 1.724 8.541 11.473 2.328-1.724L19 0z" fill="#787878"/>
            </svg>
        </a>
        <a href="https://www.google.com/search?<?= http_build_query(['q' => $throwable->getMessage()]) ?>" title="Search error on Google" target="_blank">
            <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.5313 9.825H12.2407v4.6406h6.45c-.2781 1.5-1.1219 2.7688-2.3937 3.6188-1.075.7187-2.4469 1.1437-4.0594 1.1437-3.12188 0-5.7625-2.1094-6.70625-4.9437-.2375-.7188-.375-1.4875-.375-2.2781 0-.7907.1375-1.5594.375-2.27818.94687-2.83125 3.5875-4.94062 6.70935-4.94062 1.7594 0 3.3375.60625 4.5813 1.79375l3.4375-3.44063C18.1813 1.20312 15.472.015625 12.2407.015625c-4.68435 0-8.73748 2.687495-10.70935 6.606245C.718848 8.24062.256348 10.0719.256348 12.0094s.4625 3.7656 1.275002 5.3843C3.50322 21.3125 7.55635 24 12.2407 24c3.2375 0 5.95-1.075 7.9313-2.9062 2.2656-2.0875 3.575-5.1625 3.575-8.8157 0-.85-.075-1.6656-.2157-2.4531z" fill="#787878"/>
            </svg>
        </a>
    </div>

    <div class="exception-card">
        <div class="exception-class">
            <?php if ($isFriendlyException): ?>
                <span><?= $this->htmlEncode($throwable->getName())?></span>
                &mdash;
                <?= get_class($throwable) ?>
            <?php else: ?>
                <span><?= get_class($throwable) ?></span>
            <?php endif ?>
        </div>

        <div class="exception-message">
            <?= nl2br($this->htmlEncode($throwable->getMessage())) ?>
        </div>

        <?php if ($solution !== null): ?>
            <div class="solution"><?= $this->parseMarkdown($solution) ?></div>
        <?php endif ?>

        <?= $this->renderPreviousExceptions($throwable) ?>

        <textarea id="clipboard"><?= $this->htmlEncode($throwable) ?></textarea>
        <span id="copied">Copied!</span>

        <a href="#" id="copy-stacktrace" title="Copy the stacktrace for use in a bug report or pastebin">
            <svg width="26" height="30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.9998.333344H3.33317C1.8665.333344.666504 1.53334.666504 3.00001V20.3333c0 .7334.599996 1.3334 1.333336 1.3334.73333 0 1.33333-.6 1.33333-1.3334V4.33334c0-.73333.6-1.33333 1.33333-1.33333h13.3333c.7334 0 1.3334-.6 1.3334-1.33333 0-.733337-.6-1.333336-1.3334-1.333336zm5.3334 5.333336H8.6665c-1.46666 0-2.66666 1.2-2.66666 2.66666V27c0 1.4667 1.2 2.6667 2.66666 2.6667h14.6667c1.4666 0 2.6666-1.2 2.6666-2.6667V8.33334c0-1.46666-1.2-2.66666-2.6666-2.66666zM21.9998 27H9.99984c-.73333 0-1.33334-.6-1.33334-1.3333V9.66668c0-.73334.60001-1.33334 1.33334-1.33334H21.9998c.7334 0 1.3334.6 1.3334 1.33334V25.6667c0 .7333-.6 1.3333-1.3334 1.3333z" fill="#787878"/>
            </svg>
        </a>
    </div>
</header>

<main>
    <div class="call-stack">
        <?= $this->renderCallStack($throwable) ?>
    </div>
    <?php if ($request && ($requestInfo = $this->renderRequest($request)) !== ''): ?>
        <div class="request">
            <?= $requestInfo ?>
        </div>
    <?php endif ?>
    <?php if ($request && ($curlInfo = $this->renderCurl($request)) !== 'curl'): ?>
        <div class="request">
            <?= $curlInfo ?>
        </div>
    <?php endif ?>
    <div class="footer">
        <div class="flex-1">
            <p class="timestamp">
                <?= date('Y-m-d, H:i:s') ?>
            </p>
            <?php if ($request): ?>
                <p class="server">
                    <?= $this->createServerInformationLink($request) ?>
                </p>
            <?php endif ?>
            <p>
                <a href="https://spiral.dev/" target="_blank" rel="noopener noreferrer">Spiral Framework</a>
                /
                <a href="https://spiral.dev/docs/basics-errors" target="_blank" rel="noopener noreferrer">Error Handling Guide</a>
            </p>
        </div>

        <svg height="150" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 294 382">
            <path fill="#6FB7F1" d="M229 57.5 64.7 250.1 23.1 108.6 229 57.5"/>
            <path fill="#459AE1" d="m229 57.5-.3 120.5-56.4 24.8-107.6 47.3z"/>
            <path fill="#3F87D2" d="M271.9 7.1 228.7 178l.3-120.5z"/>
            <path fill="#6FB7F1" d="m215.6 230-.3 1.3-29.8 117.6-38-56.3z"/>
            <path fill="#3F87D2" d="m172.3 202.8-24.8 89.8-82.8-42.5z"/>
            <path fill="#459AE1" d="m215.6 230-68.1 62.6 24.8-89.8z"/>
        </svg>
    </div>
</main>

<script>
    <?= file_get_contents(__DIR__ . '/highlight.min.js') ?>
</script>
<script>
    window.onload = function() {
        var codeBlocks = document.querySelectorAll('.solution pre code,.codeBlock'),
            callStackItems = document.getElementsByClassName('call-stack-item');

        // If there are grouped vendor package files
        var vendorCollapse = document.getElementsByClassName('call-stack-vendor-collapse');
        for (var i = 0, imax = vendorCollapse.length; i < imax; ++i) {
            vendorCollapse[i].addEventListener('click', function (event) {
                var vendorCollapseState = this.getElementsByClassName('call-stack-vendor-state')[0];
                var vendorCollapseItems = this.parentElement.getElementsByClassName('call-stack-vendor-items')[0];

                if (vendorCollapseItems.style.display === 'block') {
                    vendorCollapseItems.style.display = 'none';
                    vendorCollapseState.innerText = '+';
                } else {
                    vendorCollapseItems.style.display = 'block';
                    vendorCollapseState.innerText = '–';
                }
            });
        }

        // highlight code blocks
        hljs.configure({
            ignoreUnescapedHTML: true,
        });
        hljs.listLanguages().forEach(function(language) {
            hljs.getLanguage(language).disableAutodetect = true;
        });
        for (var i = 0, imax = codeBlocks.length; i < imax; ++i) {
            hljs.highlightElement(codeBlocks[i]);
        }

        var refreshCallStackItemCode = function(callStackItem) {
            if (!callStackItem.getElementsByTagName('pre')[0]) {
                return;
            }
            var top = callStackItem.getElementsByClassName('code-wrap')[0].offsetTop - window.pageYOffset + 3,
                lines = callStackItem.getElementsByTagName('pre')[0].getClientRects(),
                lineNumbers = callStackItem.getElementsByClassName('lines-item'),
                errorLine = callStackItem.getElementsByClassName('error-line')[0],
                hoverLines = callStackItem.getElementsByClassName('hover-line');

            for (var i = 0, imax = lines.length; i < imax; ++i) {
                if (!lineNumbers[i]) {
                    continue;
                }

                lineNumbers[i].style.top = parseInt(lines[i].top - top) + 'px';
                hoverLines[i].style.top = parseInt(lines[i].top - top) + 'px';
                hoverLines[i].style.height = parseInt(lines[i].bottom - lines[i].top + 6) + 'px';
                hoverLines[i].style.width = hoverLines[i].parentElement.parentElement.scrollWidth + 'px'

                if (parseInt(callStackItem.getAttribute('data-line')) == i) {
                    errorLine.style.top = parseInt(lines[i].top - top) + 'px';
                    errorLine.style.height = parseInt(lines[i].bottom - lines[i].top + 6) + 'px';
                    errorLine.style.width = errorLine.parentElement.parentElement.scrollWidth + 'px';
                }
            }
        };

        for (var i = 0, imax = callStackItems.length; i < imax; ++i) {
            refreshCallStackItemCode(callStackItems[i]);

            // toggle code block visibility
            callStackItems[i].getElementsByClassName('element-wrap')[0].addEventListener('click', function (event) {
                if (event.target.nodeName.toLowerCase() === 'a') {
                    return;
                }

                var callStackItem = this.parentNode,
                    code = callStackItem.getElementsByClassName('code-wrap')[0];

                if (typeof code !== 'undefined') {
                    code.style.display = window.getComputedStyle(code).display === 'block' ? 'none' : 'block';
                    if (code.style.display === 'block') {
                        this.style.borderBottom = document.body.classList.contains('dark-theme')
                            ? '1px solid #141414'
                            : '1px solid #d0d0d0'
                        ;
                    } else {
                        this.style.borderBottom = 'none';
                    }
                    refreshCallStackItemCode(callStackItem);
                }
            });
        }

        // handle copy stacktrace action on clipboard button
        document.getElementById('copy-stacktrace').onclick = function(e) {
            e.preventDefault();
            var textarea = document.getElementById('clipboard');
            textarea.focus();
            textarea.select();

            var succeeded;
            try {
                succeeded = document.execCommand('copy');
            } catch (err) {
                succeeded = false;
            }
            if (succeeded) {
                var hint = document.getElementById('copied');
                hint.style.display = 'block';
                setTimeout(function () {
                    hint.style.display = 'none';
                }, 2000);
            } else {
                // fallback: show textarea if browser does not support copying directly
                textarea.style.top = 0;
            }
        }

        // handle theme change
        document.getElementById('dark-mode').onclick = function(e) {
            e.preventDefault();

            document.body.classList.add('dark-theme');

            setCookie('yii-exception-theme', 'dark-theme');
        }

        document.getElementById('light-mode').onclick = function(e) {
            e.preventDefault();

            document.body.classList.remove('dark-theme');

            eraseCookie('yii-exception-theme');
        }
    };

    // Highlight lines that have text in them but still support text selection:
    document.onmousedown = function() { document.getElementsByTagName('body')[0].classList.add('mousedown'); }
    document.onmouseup = function() { document.getElementsByTagName('body')[0].classList.remove('mousedown'); }

    <?php if (empty($theme)): ?>
    var theme = getCookie('yii-exception-theme');

    if (theme) {
        document.body.classList.add(theme);
    }
    <?php endif; ?>

    function setCookie(name, value) {
        var date = new Date(2100, 0, 1);
        var expires = "; expires=" + date.toUTCString();

        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');

        for (var i=0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }

        return null;
    }

    function eraseCookie(name) {
        document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }
</script>
</body>

</html>
