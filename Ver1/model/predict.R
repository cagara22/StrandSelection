library(plumber)

#' @filter cors
cors <- function(req, res) {
  
  res$setHeader("Access-Control-Allow-Origin", "*")
  
  if (req$REQUEST_METHOD == "OPTIONS") {
    res$setHeader("Access-Control-Allow-Methods","*")
    res$setHeader("Access-Control-Allow-Headers", req$HTTP_ACCESS_CONTROL_REQUEST_HEADERS)
    res$status <- 200 
    return(list())
  } else {
    plumber::forward()
  }
  
}

#* Echo back the prediction
#* @param Science8
#* @param Math9
#* @param English
#* @param Filipino
#* @param ICT10
#* @param HE
#* @param TotalIncome
#* @param MathSkills
#* @param ScienceSkills
#* @param TechSkills
#* @param LanguageSkills
#* @param SocialSkills
#* @param CommSkills
#* @param FinanceSkills
#* @param ManagementSkills
#* @param EntrepreneurSkills
#* @param TimeMgmt
#* @param Leadership
#* @param ArtSkills
#* @param MusicSkills
#* @param CulinarySkills
#* @param HomeMgmt
#* @param FashionSkills
#* @param ICTSkills
#* @param MediaSkills
#* @param DigitalSkills
#* @param Science34
#* @param Math35
#* @param ArtsDesign
#* @param HumSocial
#* @param BusEntrep
#* @param ICT36
#* @param AgriFish
#* @param HomeEcon
#* @param IndusTech
#* @param CareerGoals
#* @get /predict
predict_strand <- function(Science8, Math9, English, Filipino, ICT10, HE, TotalIncome, MathSkills, ScienceSkills, TechSkills, LanguageSkills, SocialSkills, CommSkills, FinanceSkills, ManagementSkills, EntrepreneurSkills, TimeMgmt, Leadership, ArtSkills, MusicSkills, CulinarySkills, HomeMgmt, FashionSkills, ICTSkills, MediaSkills, DigitalSkills, Science34, Math35, ArtsDesign, HumSocial, BusEntrep, ICT36, AgriFish, HomeEcon, IndusTech, CareerGoals){
  
  studentProfile <- data.frame(
    `Science...8` = character(),
    `Math...9` = character(),
    `English` = character(),
    `Filipino` = character(),
    `ICT Related Subject (If Applicable)` = character(),
    `HE Related Subject (If Applicable)` = character(),
    `Total Household Monthly Income` = character(),
    `Skills [Mathematical skills]` = numeric(),
    `Skills [Scientific skills]` = numeric(),
    `Skills [Technical skills]` = numeric(),
    `Skills [Language skills]` = numeric(),
    `Skills [Social sciences]` = numeric(),
    `Skills [Communication skills]` = numeric(),
    `Skills [Accounting and finance skills]` = numeric(),
    `Skills [Business management skills]` = numeric(),
    `Skills [Entrepreneurial skills]` = numeric(),
    `Skills [Time management]` = numeric(),
    `Skills [Leadership Skills]` = numeric(),
    `Skills [Artistic skills]` = numeric(),
    `Skills [Music skills]` = numeric(),
    `Skills [Culinary arts skills]` = numeric(),
    `Skills [Home management skills]` = numeric(),
    `Skills [Fashion and beauty skills]` = numeric(),
    `Skills [ICT Skills]` = numeric(),
    `Skills [Multimedia skills]` = numeric(),
    `Skills [Digital communication skills]` = numeric(),
    `Science...34` = numeric(),
    `Math...35` = numeric(),
    `Arts and Design` = numeric(),
    `Humanities and Social Sciences` = numeric(),
    `Business and Entrepreneurship` = numeric(),
    `Information and Communication Technology` = numeric(),
    `Agriculture and Fisheries` = numeric(),
    `Home Economics` = numeric(),
    `Industrial Arts and Technology` = numeric(),
    `Career Goals` = character(),
    stringsAsFactors = TRUE
  )
  
  new_row <- list(
    `Science...8` = Science8,
    `Math...9` = Math9,
    `English` = English,
    `Filipino` = Filipino,
    `ICT Related Subject (If Applicable)` = ICT10,
    `HE Related Subject (If Applicable)` = HE,
    `Total Household Monthly Income` = TotalIncome,
    `Skills [Mathematical skills]` = as.numeric(MathSkills),
    `Skills [Scientific skills]` = as.numeric(ScienceSkills),
    `Skills [Technical skills]` = as.numeric(TechSkills),
    `Skills [Language skills]` = as.numeric(LanguageSkills),
    `Skills [Social sciences]` = as.numeric(SocialSkills),
    `Skills [Communication skills]` = as.numeric(CommSkills),
    `Skills [Accounting and finance skills]` = as.numeric(FinanceSkills),
    `Skills [Business management skills]` = as.numeric(ManagementSkills),
    `Skills [Entrepreneurial skills]` = as.numeric(EntrepreneurSkills),
    `Skills [Time management]` = as.numeric(TimeMgmt),
    `Skills [Leadership Skills]` = as.numeric(Leadership),
    `Skills [Artistic skills]` = as.numeric(ArtSkills),
    `Skills [Music skills]` = as.numeric(MusicSkills),
    `Skills [Culinary arts skills]` = as.numeric(CulinarySkills),
    `Skills [Home management skills]` = as.numeric(HomeMgmt),
    `Skills [Fashion and beauty skills]` = as.numeric(FashionSkills),
    `Skills [ICT Skills]` = as.numeric(ICTSkills),
    `Skills [Multimedia skills]` = as.numeric(MediaSkills),
    `Skills [Digital communication skills]` = as.numeric(DigitalSkills),
    `Science...34` = as.numeric(Science34),
    `Math...35` = as.numeric(Math35),
    `Arts and Design` = as.numeric(ArtsDesign),
    `Humanities and Social Sciences` = as.numeric(HumSocial),
    `Business and Entrepreneurship` = as.numeric(BusEntrep),
    `Information and Communication Technology` = as.numeric(ICT36),
    `Agriculture and Fisheries` = as.numeric(AgriFish),
    `Home Economics` = as.numeric(HomeEcon),
    `Industrial Arts and Technology` = as.numeric(IndusTech),
    `Career Goals` = CareerGoals
  )
  studentProfile <- rbind(studentProfile, new_row)
  
  colnames(studentProfile) <- c(
    "Science...8",
    "Math...9",
    "English",
    "Filipino",
    "ICT Related Subject (If Applicable)",
    "HE Related Subject (If Applicable)",
    "Total Household Monthly Income",
    "Skills [Mathematical skills]",
    "Skills [Scientific skills]",
    "Skills [Technical skills]",
    "Skills [Language skills]",
    "Skills [Social sciences]",
    "Skills [Communication skills]",
    "Skills [Accounting and finance skills]",
    "Skills [Business management skills]",
    "Skills [Entrepreneurial skills]",
    "Skills [Time management]",
    "Skills [Leadership Skills]",
    "Skills [Artistic skills]",
    "Skills [Music skills]",
    "Skills [Culinary arts skills]",
    "Skills [Home management skills]",
    "Skills [Fashion and beauty skills]",
    "Skills [ICT Skills]",
    "Skills [Multimedia skills]",
    "Skills [Digital communication skills]",
    "Science...34",
    "Math...35",
    "Arts and Design",
    "Humanities and Social Sciences",
    "Business and Entrepreneurship",
    "Information and Communication Technology",
    "Agriculture and Fisheries",
    "Home Economics",
    "Industrial Arts and Technology",
    "Career Goals"
  )
  
  library(dplyr)
  studentProfile <- studentProfile %>%
    #Convert to factor level
    mutate(`Career Goals` = factor(`Career Goals`, levels = c('Undecided', 'Business and Management', 'Education and Training', 'Engineering and Technology', 'Healthcare and Medicine', 'Arts and Humanities', 'Law and Public Policy', 'Natural Sciences and Mathematics', 'Social Sciences and Communication', 'Information Technology and Computer Science', 'Agriculture and Environmental Science', 'Hospitality and Tourism', 'Media and Entertainment', 'Sports and Fitness', 'Trades and Vocational Skills', 'Government and Public Service', 'Non-Profit and Philanthropy'), labels = c(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17)),
           `Total Household Monthly Income` = factor(`Total Household Monthly Income`, levels = c('less than P9,100', 'P9,100-P18,200', 'P18,200-P36,400', 'P36,400-P63,700', 'P63,700-P109,200', 'P109,200-P182,000', 'greater than P182,000'), labels = c(1, 2, 3, 4, 5, 6, 7)),
           Science...8 = factor(Science...8, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0'), labels = c(1, 2, 3, 4, 5, 6)),
           Math...9 = factor(Math...9, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0'), labels = c(1, 2, 3, 4, 5, 6)),
           English = factor(English, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0'), labels = c(1, 2, 3, 4, 5, 6)),
           Filipino = factor(Filipino, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0'), labels = c(1, 2, 3, 4, 5, 6)),
           `ICT Related Subject (If Applicable)` = factor(`ICT Related Subject (If Applicable)`, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0', 'N/A'), labels = c(1, 2, 3, 4, 5, 6,7)),
           `HE Related Subject (If Applicable)` = factor(`HE Related Subject (If Applicable)`, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0', 'N/A'), labels = c(1, 2, 3, 4, 5, 6,7)))
  glimpse(studentProfile)
  
  fit_rf <- readRDS("my_random_forest_model.rds")
  strandPrediction <- predict(fit_rf, studentProfile)
  return(strandPrediction)
}