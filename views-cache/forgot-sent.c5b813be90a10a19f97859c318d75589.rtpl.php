<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Esqueceu a Senha?</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php if( $error != '' ){ ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </div>

                <form id="login-form-wrap" class="login" method="post" action="/forgot">
                    <h2>Recuperar senha</h2>
                    <p class="form-row form-row-first">
                        <label for="email">E-mail <span class="required">*</span>
                        </label>
                        <input type="email" required="true" id="email" name="email" class="input-text" style="width:350px">
                    </p>
                    <div class="clear"></div>
                    <p class="form-row">
                        <input type="submit" value="Enviar" name="login" class="button">
                        
                    </p>

                    <div class="clear"></div>
                </form> 
                <?php } ?>


                  <?php if( $error == '' ){ ?>
                    <div class="alert alert-success" role="alert">
                      <h4 class="alert-heading">E-mail enviado!</h4>
                      <p>Verifique seu e-mail e siga as instruções para recuperar a sua senha.</p>
                    </div> 
                <?php } ?>
                                 
            </div>
        </div>
    </div>
</div>