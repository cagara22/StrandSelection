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
         `ICT Related Subject (If Applicable)` = factor(`ICT Related Subject (If Applicable)`, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0', 'N/A'), labels = c(1, 2, 3, 4, 5, 6,7)),
         `HE Related Subject (If Applicable)` = factor(`HE Related Subject (If Applicable)`, levels = c('100 - 95', '94 - 90', '89 - 80', '79 - 75', '74 - 70', '69 - 0', 'N/A'), labels = c(1, 2, 3, 4, 5, 6,7)))
glimpse(clean_strand)

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

data_train <- create_train_test(clean_strand, 0.8, train = TRUE)
data_test <- create_train_test(clean_strand, 0.8, train = FALSE)

library(randomForest)
library(caret)
library(e1071)

# Define the control
trControl <- trainControl(method = "cv",
                          number = 10,
                          search = "grid")

set.seed(1234)
# Run the model
rf_default <- train(`What strand are you in?`~.,
                    data = data_train,
                    method = "rf",
                    metric = "Accuracy",
                    trControl = trControl)
# Print the results
print(rf_default)

set.seed(1234)
tuneGrid <- expand.grid(.mtry = c(1: 10))
rf_mtry <- train(`What strand are you in?`~.,
                 data = data_train,
                 method = "rf",
                 metric = "Accuracy",
                 tuneGrid = tuneGrid,
                 trControl = trControl,
                 importance = TRUE,
                 nodesize = 14,
                 ntree = 300)
print(rf_mtry)

best_mtry <- rf_mtry$bestTune$mtry 
best_mtry

store_maxnode <- list()
tuneGrid <- expand.grid(.mtry = best_mtry)
for (maxnodes in c(5: 15)) {
  set.seed(1234)
  rf_maxnode <- train(`What strand are you in?`~.,
                      data = data_train,
                      method = "rf",
                      metric = "Accuracy",
                      tuneGrid = tuneGrid,
                      trControl = trControl,
                      importance = TRUE,
                      nodesize = 14,
                      maxnodes = maxnodes,
                      ntree = 300)
  current_iteration <- toString(maxnodes)
  store_maxnode[[current_iteration]] <- rf_maxnode
}
results_mtry <- resamples(store_maxnode)
summary(results_mtry)

store_maxnode <- list()
tuneGrid <- expand.grid(.mtry = best_mtry)
for (maxnodes in c(20: 30)) {
  set.seed(1234)
  rf_maxnode <- train(`What strand are you in?`~.,
                      data = data_train,
                      method = "rf",
                      metric = "Accuracy",
                      tuneGrid = tuneGrid,
                      trControl = trControl,
                      importance = TRUE,
                      nodesize = 14,
                      maxnodes = maxnodes,
                      ntree = 300)
  key <- toString(maxnodes)
  store_maxnode[[key]] <- rf_maxnode
}
results_node <- resamples(store_maxnode)
summary(results_node)

store_maxtrees <- list()
for (ntree in c(250, 300, 350, 400, 450, 500, 550, 600, 800, 1000, 2000)) {
  set.seed(5678)
  rf_maxtrees <- train(`What strand are you in?`~.,
                       data = data_train,
                       method = "rf",
                       metric = "Accuracy",
                       tuneGrid = tuneGrid,
                       trControl = trControl,
                       importance = TRUE,
                       nodesize = 14,
                       maxnodes = 24,
                       ntree = ntree)
  key <- toString(ntree)
  store_maxtrees[[key]] <- rf_maxtrees
}
results_tree <- resamples(store_maxtrees)
summary(results_tree)


# Train the model:
# mtry = 4
# nodes = 29
# mastrees = 350
fit_rf <- train(`What strand are you in?`~.,
                data_train,
                method = "rf",
                metric = "Accuracy",
                tuneGrid = tuneGrid,
                trControl = trControl,
                importance = TRUE,
                nodesize = 14,
                ntree = 350,
                maxnodes = 29)

prediction <-predict(fit_rf, data_test)

confusionMatrix(prediction, data_test$`What strand are you in?`)

varImp(fit_rf)

class(fit_rf)
rf_model <- fit_rf$finalModel
varImpPlot(rf_model)
saveRDS(fit_rf, file = "my_random_forest_model.rds")