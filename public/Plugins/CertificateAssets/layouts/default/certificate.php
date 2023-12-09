<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $this->user->name ?>'s Certificate</title>
    <style type="text/css">
    /* Main Body */
    @page {
        margin-top: 0;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
    }

    body {
        color: #333333;
        margin: 0;
        font-weight: normal;
        font-size: 20pt;
        line-height: 100%;
    }

    h1,
    h2,
    h3,
    h4 {
        font-weight: bold;
        margin: 0;
    }

    h1 {
        font-size: 22pt;
        margin: 5mm 0;
    }

    h2 {
        font-size: 18pt;
    }

    h3 {
        font-size: 15pt;
    }

    h4 {
        font-size: 12pt;
    }

    ol,
    ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    li,
    ul {
        margin-bottom: 0.75em;
    }

    p {
        margin: 0;
        padding: 0;

    }

    p+p {
        margin-top: 1.25em;
    }

    a {
        border-bottom: 1px solid;
        text-decoration: none;
    }

    #watermark {
        position: fixed;
        top: 0;
        left: 0;
        width: 29.7cm;
        height: 21cm;
        z-index: -1000;
    }

    /* page numbers */
    .pagenum:before {
        content: counter(page);
    }

    .pagenum,
    .pagecount {
        font-family: sans-serif;
    }


    /**
        * Layout Custom CSS
         */

    .certificate-wrap {
        position: relative;
    }

    .certificate-content {
        width: 820px;
        text-align: center;
        float: right;
        font-family: RobotoSlab;
        margin-top:320px;
    }

    .certificate-content .students_name {
        font-size: 22pt;
        line-height: .8;
        font-family: helvetica;
        font-weight: 700;
        font-style: italic;
    }

    .signature-wrap {
        font-family: RobotoSlab;
        font-size: 13pt;
        line-height: .5;
        position: absolute;
        bottom: 20pt;
        width: 200pt;
        text-align: center;
        left: 50%;
        clear: both;
    }

    .signature-wrap img {
        height: 60px;
        width: auto;
    }

    .signature-image-wrap {
        margin-bottom: 10pt;
        padding-bottom: 10pt;
        border-bottom: 1px solid #555555;
    }

    .comp-name {
        line-height: 16px
    }
    </style>
</head>

<body>

    <div class="certificate-wrap">

        <div class="certificate-content">
            <h1>Certificate of Completions</h1>


            <p>This is to Certify that <span class="students_name stud-name"> <?php echo $this->user->name ?> </span>
            </p>

             <p> Successfully completed <strong><?php echo $this->course->title ?></strong> </p>
            <!-- <p class="course-name"> <b>Successfully completed </b> JAVA COURSE IN BEGINNER IN FRONT END DEVLOPEMENT</p> -->


        </div>


        <div class="signature-wrap">
            <?php
        $signature_id = get_option('certificate.signature_id');
        $signature_src = null;
        if ($signature_id){
            $signature_src = media_image_uri($signature_id)->original;

            $signature_src = explode('/', $signature_src);
            $signature_src = end($signature_src);
            $signature_src = root_path('uploads/images/'. $signature_src);
        }
        if ($signature_src){
            ?>
            <div class="signature-image-wrap">
                <img src="<?php echo $signature_src; ?>" />
            </div>
            <?php } ?>
            <div class="signature-text">

                <p> <?php echo get_option('certificate.authorise_name'); ?> </p>
                <p class="comp-name"> <strong><?php echo get_option('certificate.company_name'); ?></strong> </p>
            </div>
            <div style="clear: both"></div>
        </div>

    </div>

    <div id="watermark">
        <img src="<?php echo $this->layouts_path.'/default' ?>/certificate.png" width="100%" height="100%" />
    </div>


</body>

</html>