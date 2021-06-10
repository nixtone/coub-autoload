</div>
</div>
	</div>
</div>
<div class="total-coub-count">
    <span class="total"><?=$LIB['PAGINATION']['ITEM_COUNT']['count(ID)']?></span> / <span class="loaded"><?=$LIB['LOAD_NOW']?></span>
</div>
<footer>
    <!-- <div class="container">Footer</div> -->
</footer>

<div class="cpp add_btn" data-pp="add_coub"></div>

<div class="overlay" style="display: none;">
    <div class="popup">
        <div class="close"></div>
        <div class="inner">

            <form method="post" class="add_coub" style="display: none;">
                <input type="text" name="COUB_ID" placeholder="ID кубика">
                <input type="text" name="TAGS" placeholder="Теги через запятую">
                <input type="hidden" name="CODE" value="ADD_COUB">
                <input type="submit" value="Отправить">
            </form>

        </div>
    </div>
</div>

<script src="/static/jquery-3.5.1.min.js"></script>
<script src="/static/fancy/jquery.fancybox.min.js"></script>
<script src="/static/custom.js"></script>
</body>
</html>