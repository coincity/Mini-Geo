<div class="container">
    <div class="login-default-box">
        <h1>Upload photo</h1>
        <form action="<?php echo URL; ?>photos/addPhoto" method="post" enctype="multipart/form-data">
            <label>Select file to upload:</label>
            <input type="file" name="fileToUpload" id="fileToUpload" required />
            <input type="submit" class="login-submit-button" value="Upload Image" name="submit" />
        </form>
        <a href="<?php echo URL; ?>photos/deleteall">alle foto's verwijderen</a>
		<table>
		<thead>
			<tr>
				<td>photo</td>
				<td>speel</td>
				<!-- <td>score</td> -->
			</tr>
		</thead>
			<?php foreach ($this->photos as $photo) {
				echo "<tr>";
				echo "<td><img width=100 src=\"". $photo->location ."\"></td>";
				echo "<td><a href=\"".URL."game/play/".$photo->id."\">speel</a></td>";
				// echo "<td><img width=100 src=\"". $photo->location ."\"></td>";
				echo "</tr>";
			} ?>
		</table>
    </div>
</div>
