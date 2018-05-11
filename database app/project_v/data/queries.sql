--find food items that will help boost in vitamin X.
select FoodName
from food natural join vitamin
where vitaminName = 'Vitamin D';

--see seasonal fruits or vegetables
select FoodName, FoodType, Seasons
from food1
where (Seasons != 'All seasons') and (FoodType = 'Fruit' or FoodType = 'Vegetable');

--find food items with vitamin X with lowest price
select FoodName, Cost, VitaminName
from food natural join vitamin
where cost = (select min(cost) from food) and vitaminName = 'Vitamin D';

--find food items that have less sugar than amount X

select FoodName, MacroName, Amount
from food natural join macronutrient
where MacroName = 'Sugar'
having Amount < 10;

select FoodName, VitaminName, Amount
from food natural join vitamin
where VitaminName = 'Vitamin D'
having Amount < 30;

--find total cost of food items if I make recipe with food X's
select sum(cost)
from food
where foodName = 'Chicken' and foodName = 'Cookie' and foodName = 'Pork';

--Best way to store food
select storage
from food
where foodName = 'Chicken';

--show food items under price of X
select foodName, FoodType, cost
from food
where cost < 5;

--categorize food items with nutritional value X and list them in descending or ascending order
select foodName, vitaminName, amount
from food natural join vitamin
where vitaminName = 'Vitamin C'
order by Amount DESC;

select foodName, vitaminName, amount
from food natural join vitamin
where vitaminName = 'Vitamin C'
order by Amount;

--if I'm allergic to ingredient N, show me all the food with ingredient N
select foodName
from food natural join mineral
where mineralName = 'Selenium';

--Find foods that don't have specific nutrient but is of the same type of food
select foodName
from food natural join mineral
where mineralName != 'Selenium'
group by FoodType = 'Meat';

--I’m allergic to ingredient N, show me alternatives
Select FoodName
From food
Where foodName != ‘Chicken’ and FoodType = (select FoodType from food where foodName = ‘Chicken’);

--Find food items that are stored in cold temperatures and are of type meat
Select foodName
From food
Where stored = ‘%Cold%’ and FoodType = ‘Meat’;

--Find food items that are fruits that cost above 2 dollars
Select FoodName
From food
Where foodType = ‘fruit’ and cost > 2;

--Find food items that have these two nutrients
Select FoodName
From food natural join mineral, vitamin
Where MineralName = ‘Calcium’ and VitaminName = ‘Riboflavin’;

--Find food items that have nutrient N that is between value X and Y
Select FoodName
From food natural join vitamin
Where Amount < 10 and Amount > 20;

