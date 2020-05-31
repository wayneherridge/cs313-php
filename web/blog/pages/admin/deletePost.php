<form class="myForm" method="POST" action="/her18028-acme/products/index.php">
    <label for="invName">Product Name</label>
    <input type="text" name="invName" readonly id="invName" <?php if(isset($invName)){ echo "value='$invName'"; } elseif (isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?>>

    <label for="invDescription">Product Description</label>
    <input type="text" readonly name="invDescription" id="invDescription"
    <?php if(isset($prodInfo['invDescription'])) {echo "value='$prodInfo[invDescription]'"; }?>>

    <input type="hidden" name="action" value="deleteProd">
    <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];}?>">
    <input type="submit" name="submit" value="Delete Product">
    <a href="/her18028-acme/products/index.php" title="Cancel">Cancel</a>
</form>