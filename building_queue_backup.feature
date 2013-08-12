Feature: Building Queue
  
  in order to upgrade a Building a Players City requires Resources, Buildings and free consuming resources

  Background:                        
    Given default configurations     
    And a Player "BlackScorp"        
    And a City "BlackScorps Village" 
    And the City belongs to Player

  Scenario Outline: Successfull Building upgrade on First Buildings 
    Given following Resources in the City
      | Wood  | 100 |
      | Stone | 100 |
      | Iron  | 100 |
    And City has Consumer Resources
     | Population | 240 |
    When i start upgraid following buildings
     | <buildings> |
    And upgrade of building costs following Resources   
     | <buildings> | Wood  | <costs_wood> |
     | <buildings> | Stone | <costs_stone> |
     | <buildings> | Iron  | <costs_iron> |
    And upgrade of the building require 
     | <buildings> | Population | <population> |
    Then i should have following buildings in Building Queue    
     | <buildings> |   
    And i should have following resources
      | Wood  | <rest_wood> |
      | Stone | <rest_stone> |
      | Iron  | <rest_iron> |
    And i should have following consumer resources
     | Population | <rest_population> |

    Examples:
      | buildings | costs_wood | costs_stone | costs_iron | population | rest_wood | rest_stone | rest_iron | rest_population |
      | Main      | 90         | 80          | 70         | 5          | 10        | 20         | 30        | 235             |
      | Place     | 10         | 40          | 30         | 0          | 90        | 64         | 70        | 240             |
      | Wood      | 50         | 60          | 40         | 5          | 50        | 40         | 60        | 235             |
      | Stone     | 65         | 50          | 40         | 10         | 35        | 50         | 60        | 230             |
      | Iron      | 75         | 65          | 70         | 10         | 25        | 35         | 30        | 230             |
      | Farm      | 45         | 40          | 30         | 0          | 55        | 60         | 70        | 240             |
      | Storage   | 60         | 50          | 40         | 0          | 40        | 50         | 60        | 240             |
      | Hide      | 50         | 60          | 50         | 2          | 50        | 40         | 50        | 238             |

