<?php





	case 'defensive-advantages':
			echo genOverview($myAction, $aarContent['skillsDefensive'], $codeName, $charID, $gender);
			echo genCategoryBtns('defensive advantages', $codeName);
			echo genCategory('defensive advantages', $charID, $codeName, $gender, $stageID);

		break;
	########################################################
	case "detection-advantages":
			echo genOverview($myAction, $aarContent['skillsDetection'], $codeName, $charID, $gender);
			echo genCategoryBtns('detection advantages', $codeName);
			echo genCategory('detection advantages', $charID, $codeName, $gender, $stageID);

		break;
	########################################################
	case "faith-advantages":
			echo genOverview($myAction, $aarContent['skillsFaith'], $codeName, $charID, $gender);
			echo genCategoryBtns('faith advantages', $codeName);
			echo genCategory('faith advantages', $charID, $codeName, $gender, $stageID);

		break;
	########################################################
	case "magic-advantages":
			echo genOverview($myAction, $aarContent['skillsMagical'], $codeName, $charID, $gender);
			echo genCategoryBtns('magical advantages', $codeName);
			echo genCategory('magical advantages', $charID, $codeName, $gender, $stageID);

		break;
	########################################################
	case "mental-advantages":
			echo genOverview($myAction, $aarContent['skillsMental'], $codeName, $charID, $gender);
			echo genCategoryBtns('mental advantages', $codeName);
			echo genCategory('mental advantages', $charID, $codeName, $gender, $stageID);

		break;
	########################################################
	case "physical-advantages":
			echo genOverview($myAction, $aarContent['skillsPhysical'], $codeName, $charID, $gender);
			echo genCategoryBtns('physical advantages', $codeName);
			echo genCategory('physical advantages', $charID, $codeName, $gender, $stageID);

		break;
	########################################################
	case "restricted-advantages":
			echo genOverview($myAction, $aarContent['skillsRestricted'], $codeName, $charID, $gender);
			echo genCategoryBtns('restricted advantages', $codeName);
			echo genCategory('restricted advantages', $charID, $codeName, $gender);

		break;
	########################################################
	case "restricted-other":
			echo genOverview($myAction, $aarContent['skillsOther'], $codeName, $charID, $gender);
			echo genCategoryBtns('other advantages', $codeName);
			echo genCategory('other advantages', $charID, $codeName, $gender);

		break;
	########################################################
	##################    ADMIN STUFF     ##################
	########################################################


	case "addTrait":
			chekPrivies(4); #admin+
			echo addTrait(); //We get stuff from link here.. be careful

		break;


	########################################################
	##################    ADMIN STUFF     ##################
	########################################################


	case "add":
		chekPrivies(4); #admin+
		echo advantagesAdd(); #show my silly assed power

		break;
	########################################################
	case "edit":

		chekPrivies(4); #admin+
		echo advantagesEdit(); #process event/add to power

		break;
	########################################################
	case "insert":
		chekPrivies(4); #admin+
		echo padvantagesInsert(); #process event/add to power

		#myRedirect(THIS_PAGE);

		break;
	########################################################
	case "revise":

		#dumpDie($_POST);

		chekPrivies(4); #admin+
		echo advantagesRevise(); #process event/add to power

		#myRedirect(THIS_PAGE);

		break;
	########################################################
	case "trash":
		chekPrivies(4); #admin+
		echo powerTrash(); #process event/add to power

		break;
	########################################################

