<?php 
	include 'index.php';
?>
			<!-- content goes here -->
			<div class="schedule-new">
				<form action="" id="programplanningworksheet">
					<h3 style="text-align: center; margin-bottom:20px;">Program Planning Worksheet</h3>
					<label for="studentname">Name: </label>
					<input type="text" id="studentname" name="studentname" size="40">
					<label for="studentid">Id: </label>
					<input type="text" id="studentid" name="studentid" maxlength="7" minlength="7" size="8">
					<br>
					
					
					<label for="major">Major: </label>
						<!-- TO-DO -->
						<!-- simply display information -->
					</select>

					<label for="minor">Minor: </label>
						<!-- TO-DO -->
					</select>

					<br>

					<span>Registering for</span>
					<input type="radio" id="Fall" name="season" value="Fall">
					<label for="Fall">Fall </label>
					<input type="radio" id="Winter" name="season" value="Winter">
					<label for="Winter">Winter </label>
					<input type="radio" id="Spring" name="season" value="Spring">
					<label for="Spring">Spring </label>
					<input type="radio" id="Summer" name="season" value="Summer">
					<label for="Summer">Summer </label>
					
					<label for="year">Year </label>
					<input type="text" id="year" name="year" maxlength="4" minlength="4" size="6">
					<br>

					<span>Earned: </span> 
					<input type="text" id="creditearned" name="creditearned" maxlength="3" size="4" readonly>
					<span>credits</span>
					<span>Credits</span>
					<input type="text" id="creditenrolled" name="creditenrolled" size="3" value="0" readonly>
					<span>currently enrolled in</span>
					<br>

					<!-- Course table goes here -->
					<div id="schedule-course">
						<table id="schedulecoursetable">
							<tr>
								<b>
									<th style="width:10%px;">Course Number</th>
									<th style="width:50%;">Title</th>
									<th style="width:5%;">Credits</th>
									<th style="width:20%;"><a title="Major, minor, gen ed">Program</a></th>
									<th></th>
								</b>
							</tr>
							<tr id="schedule-course-entry">
								<th><input type='text' id="schedulecoursenumb" name="schedulecoursenumb" size="10" maxlength="8"></th>
								<th><input type='text' id="schedulecoursetitle" name="schedulecoursetitle" size="50"></th>
								<th><input type='text' id="schedulecoursecredit" name="schedulecoursecredit" size="3" maxlength="3"></th>
								<th><input type='text' id="schedulecoursetype" name="schedulecoursetype"></th>
								<th><button type='button' onclick="scheduleAddCourse(schedulecoursenumb.value, schedulecoursetitle.value, schedulecoursecredit.value, schedulecoursetype.value)">Add</button></th>
								<!-- scheduleAddCourse(schedule-coursenumb.value, schedule-coursetitle.value, schedule-coursecredit.value, schedule-coursetype.value)" -->
							</tr>
						</table>
					</div>
					<br>

					<label for="memo">Memo: </label><br>
					<textarea rows="8" cols="50" name="memo" form="programplanningworksheet"></textarea>
					<br>

					<input type="submit" value="Submit">

				</form>
			</div>

		</div>
</div> <!-- flexbox div ends -->

</body>
