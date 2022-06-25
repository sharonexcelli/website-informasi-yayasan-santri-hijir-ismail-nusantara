<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}


if (!function_exists('mainemailtpl')) {
    function mainemailtpl($tpl)
    {
      return '
      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html>

      <head>
          <!-- This is a simple example template that you can edit to create your own custom templates -->
          <meta http-equiv="content-type" content="text/html; charset=UTF-8">
          <!-- Facebook sharing information tags -->
          <meta property="og:title" content="*|MC:SUBJECT|*">
          <link href="http://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet" type="text/css">
          <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
          <title>Emai Subject</title>

          <style type="text/css">
              * {
                  font-family: \'Lato\', sans-serif;
                  font-weight: 400;
              }

              img {
                  max-width: 100%;
              }

              .collapse {
                  padding-right: 15px;
                  padding: 0;
              }

              body {
                  -webkit-font-smoothing: antialiased;
                  -webkit-text-size-adjust: none;
                  width: 100% !important;
                  height: 100%;
              }

              a {
                color: #323232 !important;
                font-size: 14px;
                text-decoration: none !important;
              }

              .bt {
                  padding-top: 10px;
              }

              p.callout {
                  padding: 9px;
                  font-size: 14px;
              }

              p.text {
                  padding-left: 5px;
                  font-size: 14px;
              }

              p.left {
                  padding: 5px;
                  font-size: 14px;
                  text-align: left;
              }

              .prod {
                  margin: 0;
                  padding: 0;
                  color: #aaaaaa;
              }

              .callout a {
                  font-weight: bold;
                  color: #aaaaaa;
              }

              table.head-wrap {
                  width: 100%;
              }

              .header.container table td.logo {
                  padding: 15px;
              }

              .header.container table td.label {
                  padding: 15px;
                  padding-left: 0;
              }

              table.body-wrap {
                  width: 100%;
              }

              table.footer-wrap {
                  width: 100%;
                  background-color: #f5f5f5;
                  height: 50px;
                  border-top: 2px solid #929292;
              }

              table.footer-wrap2 {
                  width: 100%;
              }

              h1,
              h2,
              h3,
              h4,
              h5,
              h6 {
                  font-family: \'Lato\', sans-serif;
                  font-weight: 700;
                  line-height: 1.1;
                  color: #000;
              }

              h1 small,
              h2 small,
              h3 small,
              h4 small,
              h5 small,
              h6 small {
                  font-size: 60%;
                  color: #197089;
                  line-height: 0;
                  text-transform: none;
              }

              h1 {
                  font-weight: 400;
                  font-size: 24px;
                  padding: 15px 0;
                  color: #166d88;
              }

              h2 {
                  font-weight: 200;
                  font-size: 37px;
                  margin: 0;
              }

              h3 {
                  font-weight: 500;
                  font-size: 27px;
              }

              h4 {
                  font-weight: 500;
                  font-size: 23px;
              }

              h5 {
                  font-weight: 900;
                  font-size: 13px;
                  color: #c2a67e;
                  background-color: #f5f5f5;
              }

              h6 {
                  font-weight: 900;
                  font-size: 14px;
                  text-transform: uppercase;
                  color: #444;
              }

              h7 {
                  font-weight: 900;
                  font-size: 14px;
                  text-transform: uppercase;
                  color: #444;
                  padding: 5px;
              }

              .collapse {
                  margin: 0 !important;
              }

              p,
              ul {
                  font-weight: normal;
                  font-size: 12px;
                  line-height: 1.6;
              }

              p.lead {
                  font-size: 13px;
              }

              p.last {
                  margin-bottom: 0;
              }

              ul li {
                  margin-left: 5px;
                  list-style-position: inside;
              }

              .container {
                  display: block !important;
                  max-width: 600px !important;
                  margin: 0 auto !important;
                  clear: both !important;
              }

              .content {
                  padding: 15px;
                  max-width: 600px;
                  margin: 0 auto;
                  display: block;
              }

              .content table {
                  width: 100%;
              }

              @media only screen and (max-width:600px) {
                  div[class=column] {
                      width: 100% !important;
                      float: none !important;
                  }

              }

              @media only screen and (max-width:600px) {
                  div[class=col3] {
                      width: 100% !important;
                      float: left !important;
                      text-align: left !important;
                      padding-top: 15px;
                      margin-top: 15px;
                  }

              }

              @media only screen and (max-width:600px) {
                  div[class=col2] {
                      width: 100% !important;
                      float: left;
                      text-align: left;
                  }

              }

              @media only screen and (max-width:600px) {
                  [class=desc] {
                      display: none !important;
                      height: 0;
                      overflow: hidden;
                  }

              }

              @media only screen and (max-width:600px) {
                  .column {
                      width: 100% !important;
                      float: none !important;
                  }

              }

              @media only screen and (max-width:600px) {
                  .col3 {
                      width: 100% !important;
                      float: left !important;
                      text-align: left !important;
                      margin-top: 15px !important;
                      padding-top: 15px !important;
                  }

              }

              @media only screen and (max-width:600px) {
                  .col2 {
                      width: 100% !important;
                      float: left !important;
                      text-align: left !important;
                  }

              }

              @media only screen and (max-width:600px) {
                  p.desc {
                      display: none !important;
                      height: 0;
                      overflow: hidden;
                  }

              }

              @media only screen and (max-device-width: 480px) {
                  .hide {
                      max-height: none !important;
                      font-size: 12px !important;
                      display: block !important;
                  }

              }

              .hide {
                  max-height: 0;
                  font-size: 0;
                  display: none;
              }

              .column {
                  width: 49%;
                  float: left;
                  padding-bottom: 10px;
              }

              .col3 {
                  width: 35%;
                  float: right;
                  text-align: right;
              }

              .col2 {
                  width: 65%;
                  float: left;
              }

              .column-wrap {
                  margin: 0 auto;
                  max-width: 600px !important;
              }

              .column table {
                  width: 100%;
              }

              .social .column {
                  float: left;
              }

              .column3 {
                  width: 300px;
                  float: left;
              }

              .column3 tr td {
                  padding: 1px;
              }

              .column3-wrap {
                  padding: 0 !important;
                  margin: 0 auto;
                  max-width: 600px !important;
              }

              .column3 table {
                  width: 100%;
              }

              .column2 {
                  width: 240px;
                  float: left;
              }

              .column2 tr td {
                  padding: 5px;
              }

              .column2-wrap {
                  padding: 0 !important;
                  margin: 0 auto;
                  max-width: 600px !important;
              }

              .column2 table {
                  width: 100%;
              }

              .social .column {
                  float: left;
              }

              .prod {
                  width: 200px;
                  float: left;
              }

              .prod tr td {
                  padding: 5px;
              }

              .prod-wrap {
                  padding: 0 !important;
                  margin: 0 auto;
                  max-width: 600px !important;
              }

              .prod table {
                  width: 100%;
              }

              .prod .column {
                  width: 200px;
                  float: left;
              }

              .clear {
                  display: block;
                  clear: both;
              }

              .imgPromo {
                  width: 100%;
              }

              .imgPromo img {
                  display: inline;
                  width: calc(33.33% - 4px);
                  margin-right: 1px;
              }

              @media only screen and (max-width:600px) {
                  a[class=btn] {
                      display: block !important;
                      margin-bottom: 10px !important;
                      background-image: none !important;
                      margin-right: 0 !important;
                  }

              }

              @media only screen and (max-width:600px) {
                  .imgPromo img {
                      width: 100% !important;
                      margin-bottom: 5px;
                  }

              }

              @media only screen and (max-width:600px) {
                  a[class=btn] {
                      display: block !important;
                      margin-bottom: 10px !important;
                      background-image: none !important;
                      margin-right: 0 !important;
                  }

              }

              @media only screen and (max-width:600px) {
                  div[class=column] {
                      width: 100% !important;
                      float: none !important;
                  }

              }

              @media only screen and (max-width:600px) {
                  .column {
                      width: 100% !important;
                      float: none !important;
                  }

              }

              @media only screen and (max-width:600px) {
                  div[class=column] {
                      width: 100% !important;
                      float: none !important;
                  }

              }

              @media only screen and (max-width:600px) {
                  div[class=column2] {
                      width: auto !important;
                      float: none !important;
                  }

              }

              @media only screen and (max-width:600px) {
                  div[class=column3] {
                      width: auto !important;
                      float: none !important;
                  }

              }

              @media only screen and (max-width:600px) {
                  table[class=top] {
                      width: auto !important;
                      float: none !important;
                  }

              }

              @media only screen and (max-width:600px) {
                  .prod {
                      width: 150px;
                      float: left;
                  }

              }

              @media only screen and (max-width:600px) {
                  table.social div[class=column] {
                      width: auto !important;
                  }

              }
          </style>
      </head>

      <body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
          <table bgcolor="#ffffff" class="body-wrap container">
              <tr>
                  <td>
                      <div style="text-align:center;">

                          '.$tpl.'
                          <div></div>


                      </div>
                  </td>
              </tr>
          </table>

      </body>

      </html>

      ';
    }
}
