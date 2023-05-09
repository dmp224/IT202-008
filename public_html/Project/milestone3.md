<table><tr><td> <em>Assignment: </em> IT202 Milestone 3 Shop Project</td></tr>
<tr><td> <em>Student: </em> Dileesha Patel (dmp224)</td></tr>
<tr><td> <em>Generated: </em> 5/8/2023 9:26:56 PM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-008-S23/it202-milestone-3-shop-project/grade/dmp224" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Checkout Milestone3 branch</li><li>Create a new markdown file called milestone3.md</li><li>git add/commit/push immediate</li><li>Fill in the below deliverables</li><li>At the end copy the markdown and paste it into milestone3.md</li><li>Add/commit/push the changes to Milestone3</li><li>PR Milestone3 to dev and verify</li><li>PR dev to prod and verify</li><li>Checkout dev locally and pull changes to get ready for Milestone 4</li><li>Submit the direct link to this new milestone3.md file from your GitHub prod branch to Canvas</li></ol><p>Note: Ensure all images appear properly on GitHub and everywhere else. Images are only accepted from dev or prod, not localhost. All website links must be from prod (you can assume/infer this by getting your dev URL and changing dev to prod).</p></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> Orders will be able to be recorded </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707834-bf5a5b13-ec36-4597-9741-aa830c195be2.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot of the Orders table with valid data in it</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236964973-26095bb0-2db0-4f75-ba16-e906538dc2c5.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>SS showing order details from VS code DB extensions<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot of OrderItems table with validate data in it</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236965190-c004f078-8035-45b2-a330-04f7a3049d56.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>SS showing valid data in VS code DB Extension from orders table<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a screenshot of the purchase form UI from Heroku</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236965316-1c082c30-c7f2-4b28-aa76-732432849db7.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Purchase form screenshot from Heroku <br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a screenshot showing the items pending purchase from Heroku</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236965414-21846165-dc44-4b32-a2c0-16cc315724f7.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>SS showing item name, desired amount, cost and subtotal.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236965529-399c5495-f6df-4df6-b1ac-98d720f24bb4.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Before screenshot of Wrong amount  entered to check the price difference error<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236965674-c89dc25b-6a0a-44b4-8916-e3c3c5b37fb7.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>After screenshot of Invalid amount error shown to prove the price difference error<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236965795-bc9a6d8b-08c9-44b8-bb9b-50e9b3accf8c.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot showing cart button and total purchase price <br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 5: </em> Add a screenshot showing the Order Process validations from the code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236966098-daebb031-c084-4beb-838b-42b2b0f7dedf.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Code snippet for amount stock validation<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236969292-53b55ed6-1b84-47d7-ab73-cde9950a0056.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Code snippet of Payment address validation<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 6: </em> Add a screenshot showing the Order Process validations from the UI (Heroku)</td></tr>
<tr><td><table><tr><td>Missing Image</td></tr>
<tr><td> <em>Caption:</em> (missing)</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 7: </em> Briefly describe the code flow/process of the purchase process</td></tr>
<tr><td> <em>Response:</em> <div>- On the order page, the user gets to see the summary of<br>products they want to order</div><div>- They also have a form to put in<br>their address information, preloaded if available</div><div>- A user fills in the address information<br>and submits</div><div>- The data is validated to ensure that all the information is<br>available and correct (Payment method and address)</div><div>- Using the products in the cart,<br>we compare the unit price in the cart against the unit price in<br>the products table</div><div>- If the price varies, the user id notified of the<br>%change in price and asked to adjust money received</div><div>- We also compare the<br>requested quanity for a product against the available stock</div><div>- If the stock is<br>below the requested amount then the user can't proceed and has to adjust<br>the requested quanity</div><div>- If there are no errors, the order is created</div><div>- The<br>order items are copied from the cart and order_id attached</div><div>- The cart items<br>are then deleted and user redirected to order confirmation page</div><br></td></tr>
<tr><td> <em>Sub-Task 8: </em> Add related pull request link(s)</td></tr>
<tr><td>Not provided</td></tr>
<tr><td> <em>Sub-Task 9: </em> Add a direct link to heroku prod for this file</td></tr>
<tr><td>Not provided</td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Order Confirmation Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707834-bf5a5b13-ec36-4597-9741-aa830c195be2.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshot showing the order details from the purchase form and the related items that were purchased with a thank you message</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236969606-b7e36e3e-2d2a-4848-9859-434cbe2cc986.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Page showing all order information<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236969709-299ed845-7a8b-474a-a5ec-ac7b961e3169.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Orders table snippet<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236969788-3aa172f1-0b53-46e6-ad1b-02dacc18a248.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Order items table snippet<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Briefly explain how this information is retrieved and displayed from a code logic perspective</td></tr>
<tr><td> <em>Response:</em> <div>- To get the order information, we first select the order using the<br>order_id passed in the url.</div><div>- We then get the order items using an<br>inner join to the products table</div><div>- Using a foreach loop the items are<br>listed in the table</div><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add related pull request link(s)</td></tr>
<tr><td>Not provided</td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a direct link to heroku prod for this file</td></tr>
<tr><td>Not provided</td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> User will be able to see their Purchase History </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707834-bf5a5b13-ec36-4597-9741-aa830c195be2.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot showing purchase history for a user</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236970004-b33e002a-08ca-4d0c-bfbf-3188fe6921da.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot showing purchase history for a user<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot showing full details of a purchase (Order Details Page)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236970097-ae8af179-9a55-4459-a601-7616f0a8d08a.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Full details of the order (Without thank you message)<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Briefly explain the logic for showing the purchase list and click/displaying the Order Details</td></tr>
<tr><td> <em>Response:</em> <div>- To get the list of purchases,we select orders based on the user_id</div><div>-<br>The list of orders is displayed as a table with a foreach loop</div><div>-<br>Each order has an id which we use as the order number</div><div>- Once<br>you click on the order number, the user is taken to the order<br>details page</div><div>- where they can see the details</div><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add related pull request link(s)</td></tr>
<tr><td>Not provided</td></tr>
<tr><td> <em>Sub-Task 5: </em> Add a direct link to heroku prod for this file</td></tr>
<tr><td>Not provided</td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> Store Owner Purchase History </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707834-bf5a5b13-ec36-4597-9741-aa830c195be2.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add a screenshot showing purchase history from multiple users</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236970320-295e5584-dc5e-4fbe-b48c-d577a9cf4034.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Purchase history from VS code DB Extension <br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236970391-1b6fb898-2afd-4eee-a088-7208da7390c6.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Purchase history from admin page <br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a screenshot showing full details of a purchase (Order Details Page)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236970525-2b409d0e-1ec0-4170-ac6d-09b056efe591.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Full details of a purchase from a normal user<br></p>
</td></tr>
<tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236970530-778a18f8-6d94-476c-8a71-c0bf7552c964.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>URL showing user ID of the purchase <br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Briefly explain the logic for showing the purchase list and click/displaying the Order Details (mostly how it differs from the user's purchase history feature)</td></tr>
<tr><td> <em>Response:</em> <div>- To get the list of purchases, we select all orders</div><div>- The list<br>of orders is displayed as a table with a foreach loop</div><div>- Each order<br>has an id which we use as the order number</div><div>- Once you click<br>on the order number, the user is taken to the order details page</div><div>-<br>where they can see the details</div><div>- This page differs from the user's as<br>the store can see all orders unlike a user who see's only thei<br>orders.</div><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add related pull request link(s)</td></tr>
<tr><td>Not provided</td></tr>
<tr><td> <em>Sub-Task 5: </em> Add a direct link to heroku prod for this file</td></tr>
<tr><td>Not provided</td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 5: </em> Misc </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707834-bf5a5b13-ec36-4597-9741-aa830c195be2.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshot of the Cart page showing the button to place an order</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://user-images.githubusercontent.com/106767773/236970811-0acf6d10-081c-4659-b11e-41c48a6abcad.png"/></td></tr>
<tr><td> <em>Caption:</em> <p>Cart page showing button to place order<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add screenshots showing which issues are done/closed (project board) Incomplete Issues should not be closed (Milestone3 issues)</td></tr>
<tr><td><table><tr><td>Missing Image</td></tr>
<tr><td> <em>Caption:</em> (missing)</td></tr>
</table></td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-008-S23/it202-milestone-3-shop-project/grade/dmp224" target="_blank">Grading</a></td></tr></table>