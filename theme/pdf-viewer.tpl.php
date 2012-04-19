<!DOCTYPE html>
<html>
    <head>
      <?php
        if (module_exists('admin_menu')) {
          admin_menu_suppress();
        }
      ?>
      <?php //print drupal_get_html_head(); ?>
      <?php //print drupal_get_css(); ?>
      <link rel="stylesheet" href="<?php print $GLOBALS['base_url']?>/sites/all/libraries/pdf.js/web/viewer.css"/>
      <script type="text/javascript" src="<?php print $GLOBALS['base_url']?>/sites/all/libraries/pdf.js/web/compatibility.js"></script> 
      <script type="text/javascript" src="<?php print $GLOBALS['base_url']?>/sites/all/libraries/pdf.js/build/pdf.js"></script>
      <script type="text/javascript">PDFJS.workerSrc = '<?php print $GLOBALS['base_url']?>/pdf/worker_loader.js';</script>
      <script type="text/javascript">
      <?php
        $output = file_get_contents('sites/all/libraries/pdf.js/web/viewer.js');
        $output = str_replace("compressed.tracemonkey-pldi-09.pdf", $file, $output);
        $output = str_replace("kImageDirectory = './images/'", "kImageDirectory = '" . $GLOBALS['base_url'] . "/sites/all/libraries/pdf.js/web/images/'", $output);
        print $output;
      ?>
      </script> 
    </head>
  <body>
    <div id="controls">
      <button id="previous" onclick="PDFView.page--;" oncontextmenu="return false;">
        <img src="<?php print $GLOBALS['base_url']?>/sites/all/libraries/pdf.js/web/images/go-up.svg" align="top" height="16"/>
        Previous
      </button>

      <button id="next" onclick="PDFView.page++;" oncontextmenu="return false;">
        <img src="<?php print $GLOBALS['base_url']?>/sites/all/libraries/pdf.js/web/images/go-down.svg" align="top" height="16"/>
        Next
      </button>

      <div class="separator"></div>

      <input type="number" id="pageNumber" onchange="PDFView.page = this.value;" value="1" size="4" min="1" />

      <span>/</span>
      <span id="numPages">--</span>

      <div class="separator"></div>

      <button id="zoomOut" title="Zoom Out" onclick="PDFView.zoomOut();" oncontextmenu="return false;">
        <img src="<?php print $GLOBALS['base_url']?>/sites/all/libraries/pdf.js/web/images/zoom-out.svg" align="top" height="16"/>
      </button>
      <button id="zoomIn" title="Zoom In" onclick="PDFView.zoomIn();" oncontextmenu="return false;">
        <img src="<?php print $GLOBALS['base_url']?>/sites/all/libraries/pdf.js/web/images/zoom-in.svg" align="top" height="16"/>
      </button>

      <div class="separator"></div>

      <select id="scaleSelect" onchange="PDFView.parseScale(this.value);" oncontextmenu="return false;">
        <option id="customScaleOption" value="custom"></option>
        <option value="0.5">50%</option>
        <option value="0.75">75%</option>
        <option value="1">100%</option>
        <option value="1.25">125%</option>
        <option value="1.5">150%</option>
        <option value="2">200%</option>
        <option id="pageWidthOption" value="page-width">Page Width</option>
        <option id="pageFitOption" value="page-fit">Page Fit</option>
        <option id="pageAutoOption" value="auto" selected="selected">Auto</option>
      </select>

      <div class="separator"></div>

      <button id="print" onclick="window.print();" oncontextmenu="return false;">
        <img src="<?php print $GLOBALS['base_url']?>/sites/all/libraries/pdf.js/web/images/document-print.svg" align="top" height="16"/>
        Print
      </button>

      <button id="download" title="Download" onclick="PDFView.download();" oncontextmenu="return false;">
        <img src="<?php print $GLOBALS['base_url']?>/sites/all/libraries/pdf.js/web/images/download.svg" align="top" height="16"/>
        Download
      </button>

      <div class="separator"></div>

      <input id="fileInput" type="file" oncontextmenu="return false;"/>

      <div id="fileInputSeperator" class="separator"></div>

      <a href="#" id="viewBookmark" title="Bookmark (or copy) current location">
        <img src="<?php print $GLOBALS['base_url']?>/sites/all/libraries/pdf.js/web/images/bookmark.svg" alt="Bookmark" align="top" height="16"/>
      </a>

    </div>
    <div id="errorWrapper" hidden='true'>
      <div id="errorMessageLeft">
        <span id="errorMessage"></span>
        <button id="errorShowMore" onclick="" oncontextmenu="return false;">
          More Information
        </button>
        <button id="errorShowLess" onclick="" oncontextmenu="return false;" hidden='true'>
          Less Information
        </button>
      </div>
      <div id="errorMessageRight">
        <button id="errorClose" oncontextmenu="return false;">
          Close
        </button>
      </div>
      <div class="clearBoth"></div>
      <textarea id="errorMoreInfo" hidden='true' readonly="readonly"></textarea>
    </div>

    <div id="sidebar">
      <div id="sidebarBox">
        <div id="pinIcon" onClick="PDFView.pinSidebar()"></div>
        <div id="sidebarScrollView">
          <div id="sidebarView"></div>
        </div>
        <div id="outlineScrollView" hidden='true'>
          <div id="outlineView"></div>
        </div>
        <div id="sidebarControls">
          <button id="thumbsSwitch" title="Show Thumbnails" onclick="PDFView.switchSidebarView('thumbs')" data-selected>
            <img src="<?php print $GLOBALS['base_url']?>/sites/all/libraries/pdf.js/web/images/nav-thumbs.svg" align="top" height="16" alt="Thumbs" />
          </button>
          <button id="outlineSwitch" title="Show Document Outline" onclick="PDFView.switchSidebarView('outline')" disabled>
            <img src="<?php print $GLOBALS['base_url']?>/sites/all/libraries/pdf.js/web/images/nav-outline.svg" align="top" height="16" alt="Document Outline" />
          </button>
        </div>
      </div>
    </div>

    <div id="loadingBox">
        <div id="loading">Loading... 0%</div>
        <div id="loadingBar"><div class="progress"></div></div>
    </div>
    <div id="viewer"></div>
  </body>
</html>    
