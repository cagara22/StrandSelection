setwd("C:/xampp/htdocs/StrandSelection/Ver2/Model")

predict_strand <- function(skiCommunicationSkills, skiCriticalThinking, skiReadingComprehension, skiProblemSolving, skiResearchSkills, skiDigitalLiteracy, skiInnovative, skiTimeManagement, skiAdaptability, skiScientificInquiry, skiMathematicalSkills, skiLogicalReasoning, skiLabExperimentalSkills, skiAnalyticalSkills, skiResearchWriting, skiSociologicalAnalysis, skiCulturalCompetence, skiEthicalReasoning, skiHistoryPoliticalScience, skiFinancialLiteracy, skiBusinessPlanning, skiMarketing, skiAccounting, skiEntrepreneurship, skiEconomics, skiComputerHardwareSoftware, skiComputerNetworking, skiWebDevelopment, skiProgramming, skiTroubleshooting, skiGraphicsDesign, skiCulinarySkills, skiSewingFashionDesign, skiInteriorDesign, skiChildcareFamilyServices, skiNutritionFoodSafety, intCalculus, intBiology, intPhysics, intChemistry, intCreativeWriting, intCreativeNonfiction, intIntroWorldReligionsBeliefSystems, intPhilippinePoliticsGovernance, intDisciplinesIdeasSocialSciences, intAppliedEconomics, intBusinessEthicsSocialResponsibility, intFundamentalsABM, intBusinessMath, intBusinessFinance, intOrganizationManagement, intPrinciplesMarketing, intComputerProgramming, intComputerSystemServicing, intContactCenterServices, intCISCOComputerNetworking, intAnimationIllustration, intCookery, intBreadPastryProduction, intFashionDesign, intFoodBeverages, intTailoring, TotalHouseholdMonthlyIncome, acadScience, acadMath, acadEnglish, acadFilipino, acadICTRelatedSub, acadHERelatedSub, CareerPath1, CareerPath2, CareerPath3){
  studentProfile <- data.frame(
    skiCommunicationSkills = numeric(),
    skiCriticalThinking = numeric(),
    skiReadingComprehension = numeric(),
    skiProblemSolving = numeric(),
    skiResearchSkills = numeric(),
    skiDigitalLiteracy = numeric(),
    skiInnovative = numeric(),
    skiTimeManagement = numeric(),
    skiAdaptability = numeric(),
    skiScientificInquiry = numeric(),
    skiMathematicalSkills = numeric(),
    skiLogicalReasoning = numeric(),
    skiLabExperimentalSkills = numeric(),
    skiAnalyticalSkills = numeric(),
    skiResearchWriting = numeric(),
    skiSociologicalAnalysis = numeric(),
    skiCulturalCompetence = numeric(),
    skiEthicalReasoning = numeric(),
    skiHistoryPoliticalScience = numeric(),
    skiFinancialLiteracy = numeric(),
    skiBusinessPlanning = numeric(),
    skiMarketing = numeric(),
    skiAccounting = numeric(),
    skiEntrepreneurship = numeric(),
    skiEconomics = numeric(),
    skiComputerHardwareSoftware = numeric(),
    skiComputerNetworking = numeric(),
    skiWebDevelopment = numeric(),
    skiProgramming = numeric(),
    skiTroubleshooting = numeric(),
    skiGraphicsDesign = numeric(),
    skiCulinarySkills = numeric(),
    skiSewingFashionDesign = numeric(),
    skiInteriorDesign = numeric(),
    skiChildcareFamilyServices = numeric(),
    skiNutritionFoodSafety = numeric(),
    intCalculus = numeric(),
    intBiology = numeric(),
    intPhysics = numeric(),
    intChemistry = numeric(),
    intCreativeWriting = numeric(),
    intCreativeNonfiction = numeric(),
    intIntroWorldReligionsBeliefSystems = numeric(),
    intPhilippinePoliticsGovernance = numeric(),
    intDisciplinesIdeasSocialSciences = numeric(),
    intAppliedEconomics = numeric(),
    intBusinessEthicsSocialResponsibility = numeric(),
    intFundamentalsABM = numeric(),
    intBusinessMath = numeric(),
    intBusinessFinance = numeric(),
    intOrganizationManagement = numeric(),
    intPrinciplesMarketing = numeric(),
    intComputerProgramming = numeric(),
    intComputerSystemServicing = numeric(),
    intContactCenterServices = numeric(),
    intCISCOComputerNetworking = numeric(),
    intAnimationIllustration = numeric(),
    intCookery = numeric(),
    intBreadPastryProduction = numeric(),
    intFashionDesign = numeric(),
    intFoodBeverages = numeric(),
    intTailoring = numeric(),
    TotalHouseholdMonthlyIncome = character(),
    acadScience = character(),
    acadMath = character(),
    acadEnglish = character(),
    acadFilipino = character(),
    acadICTRelatedSub = character(),
    acadHERelatedSub = character(),
    CareerPath1 = character(),
    CareerPath2 = character(),
    CareerPath3 = character()
  )
  
  new_row <- list(
    skiCommunicationSkills = as.numeric(skiCommunicationSkills),
    skiCriticalThinking = as.numeric(skiCriticalThinking),
    skiReadingComprehension = as.numeric(skiReadingComprehension),
    skiProblemSolving = as.numeric(skiProblemSolving),
    skiResearchSkills = as.numeric(skiResearchSkills),
    skiDigitalLiteracy = as.numeric(skiDigitalLiteracy),
    skiInnovative = as.numeric(skiInnovative),
    skiTimeManagement = as.numeric(skiTimeManagement),
    skiAdaptability = as.numeric(skiAdaptability),
    skiScientificInquiry = as.numeric(skiScientificInquiry),
    skiMathematicalSkills = as.numeric(skiMathematicalSkills),
    skiLogicalReasoning = as.numeric(skiLogicalReasoning),
    skiLabExperimentalSkills = as.numeric(skiLabExperimentalSkills),
    skiAnalyticalSkills = as.numeric(skiAnalyticalSkills),
    skiResearchWriting = as.numeric(skiResearchWriting),
    skiSociologicalAnalysis = as.numeric(skiSociologicalAnalysis),
    skiCulturalCompetence = as.numeric(skiCulturalCompetence),
    skiEthicalReasoning = as.numeric(skiEthicalReasoning),
    skiHistoryPoliticalScience = as.numeric(skiHistoryPoliticalScience),
    skiFinancialLiteracy = as.numeric(skiFinancialLiteracy),
    skiBusinessPlanning = as.numeric(skiBusinessPlanning),
    skiMarketing = as.numeric(skiMarketing),
    skiAccounting = as.numeric(skiAccounting),
    skiEntrepreneurship = as.numeric(skiEntrepreneurship),
    skiEconomics = as.numeric(skiEconomics),
    skiComputerHardwareSoftware = as.numeric(skiComputerHardwareSoftware),
    skiComputerNetworking = as.numeric(skiComputerNetworking),
    skiWebDevelopment = as.numeric(skiWebDevelopment),
    skiProgramming = as.numeric(skiProgramming),
    skiTroubleshooting = as.numeric(skiTroubleshooting),
    skiGraphicsDesign = as.numeric(skiGraphicsDesign),
    skiCulinarySkills = as.numeric(skiCulinarySkills),
    skiSewingFashionDesign = as.numeric(skiSewingFashionDesign),
    skiInteriorDesign = as.numeric(skiInteriorDesign),
    skiChildcareFamilyServices = as.numeric(skiChildcareFamilyServices),
    skiNutritionFoodSafety = as.numeric(skiNutritionFoodSafety),
    intCalculus = as.numeric(intCalculus),
    intBiology = as.numeric(intBiology),
    intPhysics = as.numeric(intPhysics),
    intChemistry = as.numeric(intChemistry),
    intCreativeWriting = as.numeric(intCreativeWriting),
    intCreativeNonfiction = as.numeric(intCreativeNonfiction),
    intIntroWorldReligionsBeliefSystems = as.numeric(intIntroWorldReligionsBeliefSystems),
    intPhilippinePoliticsGovernance = as.numeric(intPhilippinePoliticsGovernance),
    intDisciplinesIdeasSocialSciences = as.numeric(intDisciplinesIdeasSocialSciences),
    intAppliedEconomics = as.numeric(intAppliedEconomics),
    intBusinessEthicsSocialResponsibility = as.numeric(intBusinessEthicsSocialResponsibility),
    intFundamentalsABM = as.numeric(intFundamentalsABM),
    intBusinessMath = as.numeric(intBusinessMath),
    intBusinessFinance = as.numeric(intBusinessFinance),
    intOrganizationManagement = as.numeric(intOrganizationManagement),
    intPrinciplesMarketing = as.numeric(intPrinciplesMarketing),
    intComputerProgramming = as.numeric(intComputerProgramming),
    intComputerSystemServicing = as.numeric(intComputerSystemServicing),
    intContactCenterServices = as.numeric(intContactCenterServices),
    intCISCOComputerNetworking = as.numeric(intCISCOComputerNetworking),
    intAnimationIllustration = as.numeric(intAnimationIllustration),
    intCookery = as.numeric(intCookery),
    intBreadPastryProduction = as.numeric(intBreadPastryProduction),
    intFashionDesign = as.numeric(intFashionDesign),
    intFoodBeverages = as.numeric(intFoodBeverages),
    intTailoring = as.numeric(intTailoring),
    TotalHouseholdMonthlyIncome = TotalHouseholdMonthlyIncome,
    acadScience = acadScience,
    acadMath = acadMath,
    acadEnglish = acadEnglish,
    acadFilipino = acadFilipino,
    acadICTRelatedSub = acadICTRelatedSub,
    acadHERelatedSub = acadHERelatedSub,
    CareerPath1 = CareerPath1,
    CareerPath2 = CareerPath2,
    CareerPath3 = CareerPath3
  )
  studentProfile <- rbind(studentProfile, new_row)
  
  suppressWarnings(suppressMessages(library(dplyr)))
  career_path_groups <- list(
    STEMRelated = c('Chemical Engineer', 'Industrial Engineer', 'Biologist', 'Mathematician', 'Statistician', 'Physicist', 'Architect', 'Doctor', 'Registered Nurse', 'Physical Therapist', 'Pharmacist', 'Civil Engineer', 'Mechanical Engineer', 'Food Technologist', 'Environmental Scientist'),
    HUMSSRelated = c('Social Scientist', 'Psychologist', 'Philosopher', 'Social Worker', 'Political Scientist', 'Foreign Service Officer', 'Police', 'Fireman', 'Soldier', 'Communication Specialist', 'Educator', 'Journalist', 'Broadcast Journalist'),
    ABMRelated = c('Entrepreneur', 'Tourism Manager', 'Business Administrator', 'Accountant', 'Business Economist', 'Banking and Finance Specialist', 'Management Consultant'),
    Undecided = c('Undecided'),
    TVLICTRelated = c('IT Specialist', 'Software Developer', 'Computer Engineer', 'Software Engineer', 'Network Administrator', 'Digital Media Designer', 'Web Developer', 'Cybersecurity Analyst', 'Data Scientist', 'Information Systems Manager'),
    TVLHERelated = c('Chef', 'Pastry Chef', 'Fashion Designer', 'Textile Designer', 'Family and Consumer Sciences Educator', 'Interior Designer', 'Home Economics Educator', 'Event Planner', 'Nutritionist', 'Dietitian', 'Hotel Manager', 'Restaurant Manager', 'Child Life Specialist', 'Family Counselor', 'Food Service Manager'),
    NoA = c('NA')
  )
  map_categories_to_group <- function(category, groups) {
    for (group_name in names(groups)) {
      if (category %in% groups[[group_name]]) {
        return(group_name)
      }
    }
    return('Other')
  }
  overallStudentProfile <- studentProfile %>%
    #Convert to factor level
    mutate(TotalHouseholdMonthlyIncome = factor(TotalHouseholdMonthlyIncome, levels = c('less than P9,100', 'P9,100-P18,200', 'P18,200-P36,400', 'P36,400-P63,700', 'P63,700-P109,200', 'P109,200-P182,000', 'greater than P182,000'), labels = c(1, 2, 3, 4, 5, 6, 7)),
           acadScience = factor(acadScience, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0'), labels = c(1, 2, 3, 4, 5, 6)),
           acadMath = factor(acadMath, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0'), labels = c(1, 2, 3, 4, 5, 6)),
           acadEnglish = factor(acadEnglish, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0'), labels = c(1, 2, 3, 4, 5, 6)),
           acadFilipino = factor(acadFilipino, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0'), labels = c(1, 2, 3, 4, 5, 6)),
           acadICTRelatedSub = factor(acadICTRelatedSub, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0', 'NA'), labels = c(1, 2, 3, 4, 5, 6,7)),
           acadHERelatedSub = factor(acadHERelatedSub, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0', 'NA'), labels = c(1, 2, 3, 4, 5, 6,7)),
           CareerPath1 = factor(sapply(CareerPath1, map_categories_to_group, career_path_groups), levels = names(career_path_groups), labels = c(1, 2, 3, 4, 5, 6, 7)),
           CareerPath2 = factor(sapply(CareerPath2, map_categories_to_group, career_path_groups), levels = names(career_path_groups), labels = c(1, 2, 3, 4, 5, 6, 7)),
           CareerPath3 = factor(sapply(CareerPath3, map_categories_to_group, career_path_groups), levels = names(career_path_groups), labels = c(1, 2, 3, 4, 5, 6, 7))
    )
  # glimpse(overallStudentProfile)
  skiStudentProfile <- overallStudentProfile %>%
    select(-c(intCalculus, intBiology, intPhysics, intChemistry, intCreativeWriting, intCreativeNonfiction, intIntroWorldReligionsBeliefSystems, intPhilippinePoliticsGovernance, intDisciplinesIdeasSocialSciences, intAppliedEconomics, intBusinessEthicsSocialResponsibility, intFundamentalsABM, intBusinessMath, intBusinessFinance, intOrganizationManagement, intPrinciplesMarketing, intComputerProgramming, intComputerSystemServicing, intContactCenterServices, intCISCOComputerNetworking, intAnimationIllustration, intCookery, intBreadPastryProduction, intFashionDesign, intFoodBeverages, intTailoring, TotalHouseholdMonthlyIncome, acadScience, acadMath, acadEnglish, acadFilipino, acadICTRelatedSub, acadHERelatedSub, CareerPath1, CareerPath2, CareerPath3))
  intStudentProfile <- overallStudentProfile %>%
    select(c(intCalculus, intBiology, intPhysics, intChemistry, intCreativeWriting, intCreativeNonfiction, intIntroWorldReligionsBeliefSystems, intPhilippinePoliticsGovernance, intDisciplinesIdeasSocialSciences, intAppliedEconomics, intBusinessEthicsSocialResponsibility, intFundamentalsABM, intBusinessMath, intBusinessFinance, intOrganizationManagement, intPrinciplesMarketing, intComputerProgramming, intComputerSystemServicing, intContactCenterServices, intCISCOComputerNetworking, intAnimationIllustration, intCookery, intBreadPastryProduction, intFashionDesign, intFoodBeverages, intTailoring))
  acadStudentProfile <- overallStudentProfile %>%
    select(c(acadScience, acadMath, acadEnglish, acadFilipino, acadICTRelatedSub, acadHERelatedSub))
  carStudentProfile <- overallStudentProfile %>%
    select(c(CareerPath1, CareerPath2, CareerPath3))
  skiandintStudentProfile <- overallStudentProfile %>%
    select(-c(TotalHouseholdMonthlyIncome, acadScience, acadMath, acadEnglish, acadFilipino, acadICTRelatedSub, acadHERelatedSub, CareerPath1, CareerPath2, CareerPath3))
  
  overall_rf <- readRDS("my_random_forest_model.rds")
  ski_rf <- readRDS("my_random_forest_model_ski.rds")
  int_rf <- readRDS("my_random_forest_model_int.rds")
  acad_rf <- readRDS("my_random_forest_model_acad.rds")
  car_rf <- readRDS("my_random_forest_model_career.rds")
  skiandint_rf <- readRDS("my_random_forest_model_skiandint.rds")
  
  suppressWarnings(suppressMessages(library(randomForest)))
  
  overallStrandPrediction <- predict(overall_rf, overallStudentProfile, type = "prob")
  skiStrandPrediction <- predict(ski_rf, skiStudentProfile, type = "prob")
  intStrandPrediction <- predict(int_rf, intStudentProfile, type = "prob")
  acadStrandPrediction <- predict(acad_rf, acadStudentProfile, type = "prob")
  carStrandPrediction <- predict(car_rf, carStudentProfile, type = "prob")
  skiandintStrandPrediction <- predict(skiandint_rf, skiandintStudentProfile, type = "prob")
  
  weight_skills <- 0.172
  weight_academic <- 0.325
  weight_interest <- 0.275
  weight_career <- 0.225
  
  student_scores <- data.frame(
    Strand = c('STEM', 'HUMSS', 'ABM', 'GAS', 'TVL-ICT', 'TVL-HE'),  # Strands 1 to 6
    Skills_Probability = skiStrandPrediction[1, ],
    Academic_Probability = acadStrandPrediction[1, ],
    Interest_Probability = intStrandPrediction[1, ],
    Career_Probability = carStrandPrediction[1, ]
  )
  
  student_scores$Total_Score <- (
    student_scores$Skills_Probability * weight_skills +
      student_scores$Academic_Probability * weight_academic +
      student_scores$Interest_Probability * weight_interest +
      student_scores$Career_Probability * weight_career
  )
  
  
  student_scores$Percentage_Score <- (student_scores$Total_Score / 1.0) * 100
  
  order_student_scores <- student_scores[order(-student_scores$Total_Score), ]
  most_suitable_strand <- order_student_scores$Strand[1]
  
  suppressWarnings(suppressMessages(library(jsonlite)))
  
  student_scores_json <- toJSON(student_scores, pretty = TRUE)
  
  result <- list(
    MostSuitableStrand = most_suitable_strand,
    StudentScores = fromJSON(student_scores_json)
  )
  
  result <- toJSON(result, pretty = TRUE)
  
  return(result)
}

# strand <- predict_strand(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 5, 5, 5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'P36,400-P63,700', '100 - 95', '100 - 95', '89 - 80', '89 - 80', 'N/A', 'N/A', 'Chemical Engineer', 'Industrial Engineer', 'Biologist')

jsonfile <- commandArgs(trailingOnly = TRUE)

# input_json <- '{"skiCommunicationSkills":1,"skiCriticalThinking":1,"skiReadingComprehension":1,"skiProblemSolving":1,"skiResearchSkills":1,"skiDigitalLiteracy":1,"skiInnovative":1,"skiTimeManagement":1,"skiAdaptability":1,"skiScientificInquiry":1,"skiMathematicalSkills":1,"skiLogicalReasoning":1,"skiLabExperimentalSkills":1,"skiAnalyticalSkills":1,"skiResearchWriting":0,"skiSociologicalAnalysis":0,"skiCulturalCompetence":0,"skiEthicalReasoning":0,"skiHistoryPoliticalScience":0,"skiFinancialLiteracy":0,"skiBusinessPlanning":0,"skiMarketing":0,"skiAccounting":0,"skiEntrepreneurship":0,"skiEconomics":0,"skiComputerHardwareSoftware":0,"skiComputerNetworking":0,"skiWebDevelopment":0,"skiProgramming":0,"skiTroubleshooting":0,"skiGraphicsDesign":0,"skiCulinarySkills":0,"skiSewingFashionDesign":0,"skiInteriorDesign":0,"skiChildcareFamilyServices":0,"skiNutritionFoodSafety":0,"intCalculus":5,"intBiology":5,"intPhysics":5,"intChemistry":5,"intCreativeWriting":1,"intCreativeNonfiction":1,"intIntroWorldReligionsBeliefSystems":1,"intPhilippinePoliticsGovernance":1,"intDisciplinesIdeasSocialSciences":1,"intAppliedEconomics":1,"intBusinessEthicsSocialResponsibility":1,"intFundamentalsABM":1,"intBusinessMath":1,"intBusinessFinance":1,"intOrganizationManagement":1,"intPrinciplesMarketing":1,"intComputerProgramming":1,"intComputerSystemServicing":1,"intContactCenterServices":1,"intCISCOComputerNetworking":1,"intAnimationIllustration":1,"intCookery":1,"intBreadPastryProduction":1,"intFashionDesign":1,"intFoodBeverages":1,"intTailoring":1,"TotalHouseholdMonthlyIncome":"P18,200-P36,400","acadScience":"100 - 95","acadMath":"100 - 95","acadEnglish":"89 - 80","acadFilipino":"89 - 80","acadICTRelatedSub":"N/A","acadHERelatedSub":"N/A","CareerPath1":"Chemical Engineer","CareerPath2":"Industrial Engineer","CareerPath3":"N/A"}'

user_input <- jsonlite::fromJSON(jsonfile)

# print(user_input)

strand <- predict_strand(
  user_input$skiCommunicationSkills,
  user_input$skiCriticalThinking,
  user_input$skiReadingComprehension,
  user_input$skiProblemSolving,
  user_input$skiResearchSkills,
  user_input$skiDigitalLiteracy,
  user_input$skiInnovative,
  user_input$skiTimeManagement,
  user_input$skiAdaptability,
  user_input$skiScientificInquiry,
  user_input$skiMathematicalSkills,
  user_input$skiLogicalReasoning,
  user_input$skiLabExperimentalSkills,
  user_input$skiAnalyticalSkills,
  user_input$skiResearchWriting,
  user_input$skiSociologicalAnalysis,
  user_input$skiCulturalCompetence,
  user_input$skiEthicalReasoning,
  user_input$skiHistoryPoliticalScience,
  user_input$skiFinancialLiteracy,
  user_input$skiBusinessPlanning,
  user_input$skiMarketing,
  user_input$skiAccounting,
  user_input$skiEntrepreneurship,
  user_input$skiEconomics,
  user_input$skiComputerHardwareSoftware,
  user_input$skiComputerNetworking,
  user_input$skiWebDevelopment,
  user_input$skiProgramming,
  user_input$skiTroubleshooting,
  user_input$skiGraphicsDesign,
  user_input$skiCulinarySkills,
  user_input$skiSewingFashionDesign,
  user_input$skiInteriorDesign,
  user_input$skiChildcareFamilyServices,
  user_input$skiNutritionFoodSafety,
  user_input$intCalculus,
  user_input$intBiology,
  user_input$intPhysics,
  user_input$intChemistry,
  user_input$intCreativeWriting,
  user_input$intCreativeNonfiction,
  user_input$intIntroWorldReligionsBeliefSystems,
  user_input$intPhilippinePoliticsGovernance,
  user_input$intDisciplinesIdeasSocialSciences,
  user_input$intAppliedEconomics,
  user_input$intBusinessEthicsSocialResponsibility,
  user_input$intFundamentalsABM,
  user_input$intBusinessMath,
  user_input$intBusinessFinance,
  user_input$intOrganizationManagement,
  user_input$intPrinciplesMarketing,
  user_input$intComputerProgramming,
  user_input$intComputerSystemServicing,
  user_input$intContactCenterServices,
  user_input$intCISCOComputerNetworking,
  user_input$intAnimationIllustration,
  user_input$intCookery,
  user_input$intBreadPastryProduction,
  user_input$intFashionDesign,
  user_input$intFoodBeverages,
  user_input$intTailoring,
  user_input$TotalHouseholdMonthlyIncome,
  user_input$acadScience,
  user_input$acadMath,
  user_input$acadEnglish,
  user_input$acadFilipino,
  user_input$acadICTRelatedSub,
  user_input$acadHERelatedSub,
  user_input$CareerPath1,
  user_input$CareerPath2,
  user_input$CareerPath3
)
print(strand)
