<div class="users form">
    <?= $this->Element('notloggedin_header', array('active' => 'products')); ?>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h2 class="page-header text-center">You've got mail!</h2>

            <p class="text-center lead">..just to prove to us that you are you, you must click on the link in this e-mail.</p>
        </div>
        <!-- end col md 12 -->
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 bottom2">
            <?= $this->Element('shop_header', array('step' => 2)); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <p class="text-center"></p>

            <p class="text-center">Waiting for an email sometimes feels like you're waiting for ages. Sorry about that, let us take care of the waiting by offering you this
                awesome ICG related movie to get you in the mood.</p>

            <style>.embed-container {
                    position: relative;
                    padding-bottom: 56.25%;
                    height: 0;
                    overflow: hidden;
                    max-width: 100%;
                    height: auto;
                }

                .embed-container iframe, .embed-container object, .embed-container embed {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                }</style>
            <div class='embed-container'>
                <iframe src='//www.youtube.com/embed/w6sUtZgJ-BQ' frameborder='0' allowfullscreen></iframe>
            </div>
            <p class="text-center"></p>

        </div>
    </div>
</div>