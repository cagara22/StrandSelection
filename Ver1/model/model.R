setwd("D:/3rd year 2nd sem/Cap1/System/model")
set.seed(678)

library(readr)
strand <- read_csv("strandDummy.csv")
# View(strand)

shuffle_index <- sample(1:nrow(strand))
head(shuffle_index)

strand <- strand[shuffle_index, ]
head(strand)

library(dplyr)
# Drop variables
clean_strand <- strand %>%
  select(-c(Timestamp, Email, `Full Name (Optional)`, Age, Sex, `What grade are you in?`)) %>%
  #Convert to factor level
  mutate(`What strand are you in?` = factor(`What strand are you in?`, levels = c('STEM', 'HUMSS', 'ABM', 'GAS', 'TVL - HE', 'TVL - ICT'), labels = c(1, 2, 3, 4, 5,6)),
         `Career Goals` = factor(`Career Goals`, levels = c('Undecided', 'Business and Management', 'Education and Training', 'Engineering and Technology', 'Healthcare and Medicine', 'Arts and Humanities', 'Law and Public Policy', 'Natural Sciences and Mathematics', 'Social Sciences and Communication', 'Information Technology and Computer Science', 'Agriculture and Environmental Science', 'Hospitality and Tourism', 'Media and Entertainment', 'Sports and Fitness', 'Trades and Vocational Skills', 'Government and Public Service', 'Non-Profit and Philanthropy'), labels = c(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17)),
         `Total Household Monthly Income` = factor(`Total Household Monthly Income`, levels = c('less than P9,100', 'P9,100-P18,200', 'P18,200-P36,400', 'P36,400-P63,700', 'P63,700-P109,200', 'P109,200-P182,000', 'greater than P182,000'), labels = c(1, 2, 3, 4, 5, 6, 7)),
         Science...8 = factor(Science...8, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0'), labels = c(1, 2, 3, 4, 5, 6)),
         Math...9 = factor(Math...9, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0'), labels = c(1, 2, 3, 4, 5, 6)),
         English = factor(English, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0'), labels = c(1, 2, 3, 4, 5, 6)),
         Filipino = factor(Filipino, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0'), labels = c(1, 2, 3, 4, 5, 6)),
         `ICT Related Subject (If Applicable)` = factor(`ICT Related Subject (If Applicable)`, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0', 'N/A'), labels = c(1, 2, 3, 4, 5, 6, 7)),
         `HE Related Subject (If Applicable)` = factor(`HE Related Subject (If Applicable)`, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0', 'N/A'), labels = c(1, 2, 3, 4, 5, 6, 7)))
glimpse(clean_strand)

acadPer_strand <- strand %>%
  select(-c(Timestamp, Email, `Full Name (Optional)`, Age, Sex, `What grade are you in?`, `Total Household Monthly Income`, `Skills [Mathematical skills]`, `Skills [Scientific skills]`, `Skills [Technical skills]`, `Skills [Language skills]`, `Skills [Social sciences]`, `Skills [Communication skills]`, `Skills [Accounting and finance skills]`, `Skills [Business management skills]`, `Skills [Entrepreneurial skills]`, `Skills [Time management]`, `Skills [Leadership Skills]`, `Skills [Artistic skills]`, `Skills [Music skills]`, `Skills [Culinary arts skills]`, `Skills [Home management skills]`, `Skills [Fashion and beauty skills]`, `Skills [ICT Skills]`, `Skills [Multimedia skills]`, `Skills [Digital communication skills]`, Science...34, Math...35, `Arts and Design`, `Humanities and Social Sciences`, `Business and Entrepreneurship`, `Information and Communication Technology`, `Agriculture and Fisheries`, `Home Economics`, `Industrial Arts and Technology`, `Career Goals`)) %>% 
  #Convert to factor level
  mutate(`What strand are you in?` = factor(`What strand are you in?`, levels = c('STEM', 'HUMSS', 'ABM', 'GAS', 'TVL - HE', 'TVL - ICT'), labels = c(1, 2, 3, 4, 5,6)),
         Science...8 = factor(Science...8, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0'), labels = c(1, 2, 3, 4, 5, 6)),
         Math...9 = factor(Math...9, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0'), labels = c(1, 2, 3, 4, 5, 6)),
         English = factor(English, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0'), labels = c(1, 2, 3, 4, 5, 6)),
         Filipino = factor(Filipino, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0'), labels = c(1, 2, 3, 4, 5, 6)),
         `ICT Related Subject (If Applicable)` = factor(`ICT Related Subject (If Applicable)`, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0', 'N/A'), labels = c(1, 2, 3, 4, 5, 6, 7)),
         `HE Related Subject (If Applicable)` = factor(`HE Related Subject (If Applicable)`, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0', 'N/A'), labels = c(1, 2, 3, 4, 5, 6, 7)))
glimpse(acadPer_strand)

skills_strand <- strand %>%
  select(-c(Timestamp, Email, `Full Name (Optional)`, Age, Sex, `What grade are you in?`, `Total Household Monthly Income`, Science...8, Math...9, English, Filipino, `ICT Related Subject (If Applicable)`, `HE Related Subject (If Applicable)`, Science...34, Math...35, `Arts and Design`, `Humanities and Social Sciences`, `Business and Entrepreneurship`, `Information and Communication Technology`, `Agriculture and Fisheries`, `Home Economics`, `Industrial Arts and Technology`, `Career Goals`)) %>% 
  #Convert to factor level
  mutate(`What strand are you in?` = factor(`What strand are you in?`, levels = c('STEM', 'HUMSS', 'ABM', 'GAS', 'TVL - HE', 'TVL - ICT'), labels = c(1, 2, 3, 4, 5,6)))
glimpse(skills_strand)

interest_strand <- strand %>%
  select(-c(Timestamp, Email, `Full Name (Optional)`, Age, Sex, `What grade are you in?`, `Total Household Monthly Income`, Science...8, Math...9, English, Filipino, `ICT Related Subject (If Applicable)`, `HE Related Subject (If Applicable)`, `Skills [Mathematical skills]`, `Skills [Scientific skills]`, `Skills [Technical skills]`, `Skills [Language skills]`, `Skills [Social sciences]`, `Skills [Communication skills]`, `Skills [Accounting and finance skills]`, `Skills [Business management skills]`, `Skills [Entrepreneurial skills]`, `Skills [Time management]`, `Skills [Leadership Skills]`, `Skills [Artistic skills]`, `Skills [Music skills]`, `Skills [Culinary arts skills]`, `Skills [Home management skills]`, `Skills [Fashion and beauty skills]`, `Skills [ICT Skills]`, `Skills [Multimedia skills]`, `Skills [Digital communication skills]`, `Career Goals`)) %>% 
  #Convert to factor level
  mutate(`What strand are you in?` = factor(`What strand are you in?`, levels = c('STEM', 'HUMSS', 'ABM', 'GAS', 'TVL - HE', 'TVL - ICT'), labels = c(1, 2, 3, 4, 5,6)))
glimpse(interest_strand)

create_train_test <- function(data, size = 0.8, train = TRUE) {
  n_row = nrow(data)
  total_row = size * n_row
  train_sample <- 1: total_row
  if (train == TRUE) {
    return (data[train_sample, ])
  } else {
    return (data[-train_sample, ])
  }
}

train <- create_train_test(clean_strand, 0.8, train = TRUE)
test <- create_train_test(clean_strand, 0.8, train = FALSE)

acadPerdata_train <- create_train_test(acadPer_strand, 0.8, train = TRUE)
acadPerdata_test <- create_train_test(acadPer_strand, 0.8, train = FALSE)

skillsdata_train <- create_train_test(skills_strand, 0.8, train = TRUE)
skillsdata_test <- create_train_test(skills_strand, 0.8, train = FALSE)

interestdata_train <- create_train_test(interest_strand, 0.8, train = TRUE)
interestdata_test <- create_train_test(interest_strand, 0.8, train = FALSE)

# dim(data_train)
# dim(data_test)

prop.table(table(acadPerdata_train$`What strand are you in?`))
prop.table(table(acadPerdata_test$`What strand are you in?`))

prop.table(table(skillsdata_train$`What strand are you in?`))
prop.table(table(skillsdata_test$`What strand are you in?`))

prop.table(table(interestdata_train$`What strand are you in?`))
prop.table(table(interestdata_test$`What strand are you in?`))

library(rpart)
library(rpart.plot)

fit <- rpart(`What strand are you in?`~., data = train, method = 'class')
rpart.plot(fit, extra = 100)

fitAcadPer <- rpart(`What strand are you in?`~., data = acadPerdata_train, method = 'class')
rpart.plot(fitAcadPer, extra = 100)

fitSkills <- rpart(`What strand are you in?`~., data = skillsdata_train, method = 'class')
rpart.plot(fitSkills, extra = 100)

fitInterest <- rpart(`What strand are you in?`~., data = interestdata_train, method = 'class')
rpart.plot(fitInterest, extra = 100)

predict_fit <- predict(fit, test, type = 'class')

predict_AcadPer <- predict(fitAcadPer, acadPerdata_test, type = 'class')

predict_Skills <- predict(fitSkills, skillsdata_test, type = 'class')

predict_Interest <- predict(fitInterest, interestdata_test, type = 'class')

table_mat <- table(test$`What strand are you in?`, predict_fit)
table_mat

table_mat_AcadPer <- table(acadPerdata_test$`What strand are you in?`, predict_AcadPer)
table_mat_AcadPer

table_mat_Skills <- table(skillsdata_test$`What strand are you in?`, predict_Skills)
table_mat_Skills

table_mat_Interest <- table(interestdata_test$`What strand are you in?`, predict_Interest)
table_mat_Interest

accuracy_Test <- sum(diag(table_mat)) / sum(table_mat)

accuracy_Test_AcadPer <- sum(diag(table_mat_AcadPer)) / sum(table_mat_AcadPer)

accuracy_Test_Skills <- sum(diag(table_mat_Skills)) / sum(table_mat_Skills)

accuracy_Test_Interest <- sum(diag(table_mat_Interest)) / sum(table_mat_Interest)

print(paste('Accuracy for accuracy_Test', accuracy_Test))

print(paste('Accuracy for accuracy_Test_AcadPer', accuracy_Test_AcadPer))

print(paste('Accuracy for accuracy_Test_Skills', accuracy_Test_Skills))

print(paste('Accuracy for accuracy_Test_Interest', accuracy_Test_Interest))

accuracy_tune <- function(fit) {
  predict_unseen <- predict(fit, data_test, type = 'class')
  table_mat <- table(data_test$`What strand are you in?`, predict_unseen)
  accuracy_Test <- sum(diag(table_mat)) / sum(table_mat)
  accuracy_Test
}

control <- rpart.control(minsplit = 10,
                         minbucket = round(6 / 3),
                         maxdepth = 10,
                         cp = 1)
tune_fit <- rpart(`What strand are you in?`~., data = data_train, method = 'class', control = control)
accuracy_tune(tune_fit)

# Age = factor(Age, levels = unique(.$Age)),
# `Career Goals` = factor(`Career Goals`, levels = c('Undecided', 'Business and Management', 'Education and Training', 'Engineering and Technology', 'Healthcare and Medicine', 'Arts and Humanities', 'Law and Public Policy', 'Natural Sciences and Mathematics', 'Social Sciences and Communication', 'Information Technology and Computer Science', 'Agriculture and Environmental Science', 'Hospitality and Tourism', 'Media and Entertainment', 'Sports and Fitness', 'Trades and Vocational Skills', 'Government and Public Service', 'Non-Profit and Philanthropy'), labels = c(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17)),
# `Total Household Monthly Income` = factor(`Total Household Monthly Income`, levels = c('less than P9,100', 'P9,100-P18,200', 'P18,200-P36,400', 'P36,400-P63,700', 'P63,700-P109,200', 'P109,200-P182,000', 'greater than P182,000'), labels = c(1, 2, 3, 4, 5, 6, 7)),