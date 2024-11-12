<form action="" method="post" id="profile-form" enctype="multipart/form-data">
                <!-- FORM TAB 1 -->
                <img class="profile-preview" id="profile-preview" src=""/>
                <fieldset class="profile-tab" id="fieldset" >
                    <div class="field half-field">
                        <label for="name">Drug Name</label>
                        <input type="text" id="name" name="name" placeholder="Paracetamol"  required/>
                    </div>
                    <div class="field half-field">
                        <label for="category">Category</label>
                        <select name="category" id="category" required>
                            <option value="">Select Category</option>
                            <option value="PAINKILLER">Pain Killer</option>
                            <option value="ANTIBIOTICS">Antibiotics</option>
                            <option value="STIMULANTS">Stimulants</option>
                            <option value="INHALANTS">Inhalants</option>
                        </select>
                    </div>
                    <div class="field half-field">
                        <label for="quantity">Quantity Available</label>
                        <input type="number" step="1" id="quantity" name="quantity" placeholder="125"  required/>
                    </div>
                    <div class="field half-field">
                        <label for="price">Retail Price</label>
                        <input
                            type="number"
                            step="0.25"
                            id="price"
                            name="price"
                            placeholder="2000.50"
                            required
                        />
                    </div>
                    <div class="field half-field">
                        <label for="profile-picture">Drug Image</label>
                        <input type="file" id="profile-picture" name="drug-image" accept="image/*"/>
                    </div>
                </fieldset>
                <div class="button-group">
                <button type="submit" name="create" id="create-btn" class="button-primary">Create Drug</button>
                <a href="./dashboard.php?view=manage-drugs"><button id="cancel-btn" class="button-danger">Cancel</button></a>
                </div>
            </form>