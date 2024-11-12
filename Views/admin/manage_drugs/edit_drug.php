<form action="" method="post" id="profile-form">
    <img class="profile-preview" id="profile-preview" src="<?php echo $drug['drug_image']?>"/>
    <fieldset class="profile-tab" id="fieldset" disabled>
        <div class="field half-field">
            <label for="name">Drug Name</label>
            <input type="text" id="name" name="name" placeholder="Paracetamol" value="<?php echo $drug['drug_name']?>" required/>
        </div>
        <div class="field half-field">
                        <label for="category">Category</label>
                        <select name="category" id="category" required>
                            <option value="">Select Category</option>
                            <option value="PAINKILLER" <?php if($drug['category'] == "PAINKILLER") echo "selected" ?>>Pain Killer</option>
                            <option value="ANTIBIOTICS" <?php if($drug['category'] == "ANTIBIOTICS") echo "selected" ?>>Antibiotics</option>
                            <option value="STIMULANTS" <?php if($drug['category'] == "STIMULANTS") echo "selected" ?>>Stimulants</option>
                            <option value="INHALANTS" <?php if($drug['category'] == "INHALANTS") echo "selected" ?>>Inhalants</option>
                        </select>
                    </div>
        <div class="field half-field">
            <label for="quantity">Quantity Available</label>
            <input type="number" id="quantity" step="1" name="quantity" placeholder="125" value="<?php echo $drug['quantity']?>" required/>
        </div>
        <div class="field half-field">
            <label for="price">Price</label>
            <input
                type="number"
                step="0.25"
                id="price"
                name="price"
                placeholder="2000.50"
                value="<?php echo $drug['price']?>"
                required
            />
        </div>
        <div class="field half-field">
            <label for="profile-picture">Drug Image</label>
            <input type="file" id="profile-picture" name="drug-image" accept="image/*"/>
        </div>
    </fieldset>
    <div class="button-group">
        <button type="submit" name="update" id="update-btn" class="button-primary hidden">Update</button>
        <a href="./dashboard.php?view=manage_drugs"><button id="cancel-btn" class="button-danger hidden">Cancel</button></a>
    </div>
</form>
<div class="button-group" id="edit-group">
    <button id="edit-btn" name="edit" class="button-primary edit-btn">Edit</button>
    <a href="./dashboard.php?view=manage-drugs"><button name="edit">Go Back</button></a>
</div>