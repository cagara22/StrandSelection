library(plumber)
setwd("D:/3rd year 2nd sem/Cap1/System/model")

p <- plumb("predict.R")
p$run(port=8000)