<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/message.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
    <script src="<?php echo e(asset('static/js/api.js')); ?>"></script>
    <script>

        setInterval(function(){
            if(messageVerify() == true){
                $('.form-btn').addClass('activate-btn');
            }else{
                $('.form-btn').removeClass('activate-btn');
            }

        },1000);
        function messageVerify(){
            var name = $("input[name='name").val();
            var phone = $("input[name='phone']").val();
            var email = $("input[name='email']").val();
            var content = $("textarea[name='content']").val();
            if(!name){
                return false;
            }
            if(!phone){
                return false;
            }
            if(!(/^09\d{8}$/.test(phone))){
                return false;
            }
            if(!email){
                return false;
            }
            if(email.search(/^([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+\.(?:com|cn|tw|info|net)$/) == -1){
                return false;
            }
            if(!content){
                return false;
            }
            return true;
        }
    </script>
    <script>
        bgHeight()
        function bgHeight(){
            $('.container-bg').css('height',$(window).height()-80);

        }
        window.onresize = function(){
            bgHeight()
        }


        $(window).scroll(function() {
            bgEffect()

        });

        function bgEffect(){
            let top = document.scrollingElement.scrollTop; //触发滚动条，记录数值
            let banner_height = $('.container-bg').height()-60;
            let opacity = 1-top/banner_height;
            $('.container-bg').css('opacity',opacity);
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this;
                    const args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), wait);
                };
            }

            const faqItems = document.querySelectorAll('.faq-item');

            function calculateHeights() {
                faqItems.forEach(item => {
                    const question = item.querySelector('.faq-question');
                    const answer = item.querySelector('.faq-answer');

                    const wasOpen = item.classList.contains('open');
                    if (!wasOpen) {
                        item.classList.add('open');
                        item.offsetHeight;
                    }

                    const questionHeight = question.offsetHeight;
                    const fullHeight = item.offsetHeight;

                    item.style.setProperty('--collapsed-height', `${questionHeight}px`);
                    item.style.setProperty('--expanded-height', `${fullHeight}px`);

                    if (!wasOpen) {
                        item.classList.remove('open');
                    }
                });
            }

            calculateHeights();

            if (faqItems.length > 0) {
                faqItems[0].classList.add('open');
            }

            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                question.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isOpen = item.classList.contains('open');
                    
                    faqItems.forEach(otherItem => {
                        if (otherItem !== item && otherItem.classList.contains('open')) {
                            otherItem.classList.remove('open');
                        }
                    });

                    if (isOpen) {
                        item.classList.remove('open');
                    } else {
                        item.classList.add('open');
                    }
                });
            });

            window.addEventListener('resize', debounce(calculateHeights, 250));
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-bg" style="background-image: url('<?php echo e(asset_upload(app('cache.config')->get('page_message_back_img_pc'))); ?>')">
    </div>
    <p class="en-title"><?php echo app('cache.config')->get('page_message_title_en'); ?></p>
    <h1 class="page-title"><?php echo app('cache.config')->get('page_message_title'); ?></h1>
    <div class="main">
        <div class="quick">
            <p class="title">快速協助</p>
            <p class="desc"><?php echo app('cache.config')->get('page_message_desc'); ?></p>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="question-text">Q：<?php echo e($item->questions); ?></span>
                        <i class="iconfont faq-icon">&#xeca2;</i>
                    </div>
                    <p class="faq-answer">A：<?php echo e($item->answers); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <div class="contact">
            <p class="title">聯絡我們</p>
            <p class="desc"><?php echo app('cache.config')->get('page_lianluo_desc'); ?></p>
            <form action="" method="post" onsubmit="return messageStore()" id="message-form">
                <?php echo e(csrf_field()); ?>

                <div class="form-main">
                    <div class="form-group">
                        <label for="name">你的稱呼：</label>
                        <input class="form-control" type="text" id="name" name="name" autocomplete="name" placeholder="請留下你的稱呼" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">聯絡電話：</label>
                        <input class="form-control" type="tel" id="phone" name="phone" autocomplete="tel" placeholder="請留下你的聯絡電話號碼" required>
                    </div>
                    <div class="form-group">
                        <label for="email">電子郵箱：</label>
                        <input class="form-control" type="text" id="email" name="email" autocomplete="email" placeholder="請留下你的聯絡電子郵箱" required>
                    </div>
                    <div class="form-group">
                        <label for="type">協助類型：</label>
                        <select class="form-control" id="type" name="type">
                            <option value="1">療程咨詢</option>
                            <option value="2">退換貨</option>
                            <option value="3">修改訂單信息</option>
                            <option value="4">修改/新增訂單備注</option>
                            <option value="5">意見或建議</option>
                            <option value="0" selected>其它</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="content">問題詳述：</label>
                        <textarea class="form-control form-textarea" id="content" name="content" cols="30" rows="10"></textarea>
                    </div>
                    <button class="form-btn">確認送出</button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">取得協助</li>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web::layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/xenical-store/xenical-store-v1/resources/views/web/message.blade.php ENDPATH**/ ?>